<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem;

global $USER;
Bitrix\Main\Loader::includeModule("sale");
Bitrix\Main\Loader::includeModule("catalog");
$notShowProps = array('postcode', 'place');
$request = Context::getCurrent()->getRequest();
$siteId = Context::getCurrent()->getSite();
$currencyCode = CurrencyManager::getBaseCurrency();
$props = $_REQUEST;
$personType = !empty($props['payer']) ? $props['payer'] : 1;
$db_props = CSaleOrderProps::GetList(array("SORT" => "ASC"), array("PERSON_TYPE_ID" => $personType), false, false,
    array());
while ($prop = $db_props->GetNext()) {
    $properties[$prop['CODE']] = $prop;
}

$deliveryID = Delivery\Services\EmptyDeliveryService::getEmptyDeliveryServiceId();
$paymentID = 2;

$arResult['ERROR'] = "";
if (!$USER->isAuthorized()) {
    global $USER;
    $filter = Array("EMAIL" => $props['EMAIL']);
    $by = "NAME";
    $order = "desc";
    $rsUsers = CUser::GetList($by, $order, $filter);
    $arUser = $rsUsers->Fetch();
    if (!$arUser) {
        $pass = randString(7);
        $validData = [
            'NAME' => $props['NAME'],
            'LAST_NAME' => $props['LAST_NAME'],
            'SECOND_NAME' => $props['SECOND_NAME'],
            'PERSONAL_PHONE' => $props['PHONE'],
            'WORK_COMPANY' => $props['ORG_NAME'],
            'UF_INN' => $props['INN'],
            'UF_KPP' => $props['KPP'],
            'UF_OGRN' => $props['OGRN'],
            'UF_BIK' => $props['BIK'],
            'UF_BILL' => $props['BILL'],
            'PERSONAL_STREET' => $props['ADDRESS'],
            'EMAIL' => $props['EMAIL'],
            'LOGIN' => $props['EMAIL'],
            'PASSWORD' => $pass,
            'CONFIRM_PASSWORD' => $pass
        ];

        global $USER;
        $user = new \CUser;
        $def_group = \COption::GetOptionString("main", "new_user_registration_def_group", "");
        if ($def_group != "") {
            $validData["GROUP_ID"] = explode(",", $def_group);
        }
        $ID = $user->Add($validData);
        if (intval($ID) > 0) {
            $USER->Authorize($ID);
        } else {
            $arResult['ERROR'] .= $user->LAST_ERROR;
        }

        if ($result['STATUS'] != 'ERROR') {
            $arUser['ID'] = $result['ID'];
        } else {
            $arUser['ID'] = \CSaleUser::GetAnonymousUserID();
        }
    }
    else{
        $arResult['ERROR'] .= 'User with this E-Mail is already registered';
    }
}


foreach ($properties as $key => $property) {
    if ($property['REQUIED'] == 'Y' && empty($props[$property['CODE']])) {
        $arResult['ERROR'] .= 'Fill in the field "' . $property['NAME'] . '" <br>';
    }
}
if (!empty($arResult['ERROR'])) {
    echo json_encode(array("STATUS" => "ERROR", "HTML" => $arResult['ERROR']));
    die();
}


// Создаёт новый заказ
$order = Order::create($siteId, $USER->isAuthorized() ? $USER->GetID() : $arUser['ID']);
$order->setPersonTypeId(!empty($personType) ? $personType : 1);
//$order->setField('CURRENCY', $currencyCode);
// Создаём корзину с одним товаром
$basket = Bitrix\Sale\Basket::loadItemsForFUser(Bitrix\Sale\Fuser::getId(),
    Bitrix\Main\Context::getCurrent()->getSite());
$order->setBasket($basket);
// Создаём одну отгрузку и устанавливаем способ доставки - "Без доставки" (он служебный)
$shipmentCollection = $order->getShipmentCollection();
$shipment = $shipmentCollection->createItem();
$service = Delivery\Services\Manager::getById($deliveryID);
$shipment->setFields(array(
    'DELIVERY_ID' => $service['ID'],
    'DELIVERY_NAME' => $service['NAME'],
));
$shipmentItemCollection = $shipment->getShipmentItemCollection();
// Создаём оплату со способом #1
$paymentCollection = $order->getPaymentCollection();
$payment = $paymentCollection->createItem();
$paySystemService = PaySystem\Manager::getObjectById($paymentID);
$arDeliv = CSaleDelivery::GetByID($deliveryID);
$deliveryPrice = $arDeliv['PRICE'];

$payment->setFields(array(
    'PAY_SYSTEM_ID' => $paySystemService->getField("PAY_SYSTEM_ID"),
    'PAY_SYSTEM_NAME' => $paySystemService->getField("NAME"),
    'SUM' => $basket->getPrice() + $deliveryPrice
));

$shipment->setField("BASE_PRICE_DELIVERY", $deliveryPrice);
$shipment->setField("CUSTOM_PRICE_DELIVERY", "Y");


if ($prop['comment']) {
    $order->setField('USER_DESCRIPTION', $prop['comment']); // Устанавливаем поля комментария покупателя
}
$propertyCollection = $order->getPropertyCollection();
$propertyCollection->getPhone()->setValue($prop['PHONE']);
$propertyCollection->getPayerName()->setValue($prop['NAME']);
$propertyCollection->getUserEmail()->setValue($prop['EMAIL']);
foreach ($properties as $key => $property) {
    $propertyCollection->getItemByOrderPropertyId($property['ID'])->setValue($props[$key]);
}

$order->doFinalAction(true);
$result = $order->save();
$orderId = $order->getId();
if ($result > 0) {
    $_SESSION['SALE_ORDER_ID'][] = $orderId;
    echo json_encode($orderId);
}