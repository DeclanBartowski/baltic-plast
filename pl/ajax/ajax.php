<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Sale;

Loader::includeModule("sale");
Loader::includeModule("catalog");

function checkMinAdd($productID, $quantity, $minErrorText, $basketID = false)
{
    $result = [];
    $basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
    $basketItems = $basket->getBasketItems();
    $curCount = intval($quantity);

    foreach ($basketItems as $basketItem) {
        if ($basketID) {
            if ($productID == $basketItem->getId()) {
                $productID = $basketItem->getField('PRODUCT_ID');
                break;
            }
        } else {
            if ($productID == $basketItem->getField('PRODUCT_ID')) {
                $curCount += $basketItem->getQuantity();
                break;
            }
        }
    }

    $select = array(
        'ID',
        'IBLOCK_ID',
        'NAME',
        'PROPERTY_MINIMUM',
        'PROPERTY_LENGTH',
        'CATALOG_PRICE_1'
    );
    $filter = array('IBLOCK_ID' => IBLOCK_CATALOG_ID, 'ID' => $productID, 'ACTIVE_DATE' => 'Y', 'ACTIVE' => 'Y');
    $res = CIBlockElement::GetList(array(), $filter, false, false, $select);
    if ($fields = $res->Fetch()) {
        $length = preg_replace('/[^\d]/', '', $fields['PROPERTY_LENGTH_VALUE']);
        $minQuantity = ceil(($fields['PROPERTY_MINIMUM_VALUE'] / $length));

        if (empty($quantity) || $quantity <= 0) {
            if ($curCount < $minQuantity) {
                $result = ['TYPE' => 'SUCCESS', 'QUANTITY' => $minQuantity];
            } else {
                $result = ['TYPE' => 'SUCCESS', 'QUANTITY' => 1];
            }
        } else {
            if ($curCount < $minQuantity) {
                $result = ['TYPE' => 'ERROR', 'MESSAGE' => $minErrorText, 'PRODUCT_DATA' => $fields];
            } else {
                $result = ['TYPE' => 'SUCCESS', 'QUANTITY' => $quantity];
            }
        }
    }
    return $result;
}

global $USER;
$request = Application::getInstance()->getContext()->getRequest();
$arResult = array();
if ($request->isPost()) {
    $action = $request->getPost('action');
    switch ($action) {
        case 'add2basket':
            $id = $request->getPost('id');
            $quantity = $request->getPost('quantity');
            $error_msg = $request->getPost('error_msg');
            $added_to_basket = $request->getPost('added_to_basket');
            $arCheckResult = checkMinAdd($id, $quantity, $error_msg);
            if ($arCheckResult['TYPE'] == 'ERROR') {
                echo json_encode($arCheckResult);
            } else {
                $result = \DDS\Basketclass::add2basket($id, $arCheckResult['QUANTITY']);
                echo json_encode(['TYPE' => 'SUCCESS', 'MESSAGE' => $added_to_basket]);
            }
            break;
        case 'addSolution':
            $arProducts = $request->getPost('PRODUCTS');
            $added_to_basket = $request->getPost('added_to_basket');
            $result = [];
            foreach ($arProducts as $arProduct) {
                $id = $arProduct['ID'];
                $quantity = preg_replace('/[^\d]/', '', $arProduct['QUANTITY']);
                $error_msg = $arProduct['ERROR'];
                $arCheckResult = checkMinAdd($id, $quantity, $error_msg);
                if ($arCheckResult['TYPE'] == 'ERROR') {
                    $result['TYPE'] = 'ERROR';
                    $result['MESSAGE'] .= sprintf("%s %s\r\n", $arCheckResult['PRODUCT_DATA']['NAME'],
                        $arCheckResult['MESSAGE']);
                }
            }
            if ($result['TYPE'] == 'ERROR') {
                echo json_encode($result);
            } else {
                foreach ($arProducts as $arProduct) {
                    $id = $arProduct['ID'];
                    $quantity = preg_replace('/[^\d]/', '', $arProduct['QUANTITY']);
                    $error_msg = $arProduct['ERROR'];
                    $arCheckResult = checkMinAdd($id, $quantity, $error_msg);

                    $result = \DDS\Basketclass::add2basket($arProduct['ID'], $arCheckResult['QUANTITY']);
                }
                echo json_encode(['TYPE' => 'SUCCESS', 'MESSAGE' => $added_to_basket]);
            }

            break;
        case 'updatebasket':
            $id = $request->getPost('id');
            $quantity = $request->getPost('quantity');
            $error_msg = $request->getPost('error_msg');
            $arCheckResult = checkMinAdd($id, $quantity, $error_msg, true);

            if ($arCheckResult['TYPE'] == 'ERROR') {
                echo json_encode($arCheckResult);
            } else {
                $result = \DDS\Basketclass::updatebasket($id, $arCheckResult['QUANTITY']);
                echo json_encode($result);
            }
            break;
        case 'delete':
            $id = $request->getPost('id');
            $result = \DDS\Basketclass::delete($id);
            echo json_encode($result);
            break;
        case 'clear_basket':
            $result = \DDS\Basketclass::clearBasket();
            echo json_encode($result);
            break;
        case 'registration':
            $validData = [
                'NAME' => $_REQUEST['NAME'],
                'LAST_NAME' => $_REQUEST['LAST_NAME'],
                'PERSONAL_PHONE' => $_REQUEST['PERSONAL_PHONE'],
                'EMAIL' => $_REQUEST['EMAIL'],
                'LOGIN' => $_REQUEST['EMAIL'],
                'PASSWORD' => $_REQUEST['PASSWORD'],
                'CONFIRM_PASSWORD' => $_REQUEST['CONFIRM_PASSWORD']
            ];
            $result = \DDS\Tools::userRegister($validData);
            echo json_encode($result);
            break;
        case 'login':
            global $USER;
            $login = $request->getPost('LOGIN');
            $password = $request->getPost('PASSWORD');
            $arAuthResult = $USER->Login($login, $password, "Y");
            $APPLICATION->arAuthResult = $arAuthResult;
            echo json_encode($arAuthResult);
            break;
    }
}
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
