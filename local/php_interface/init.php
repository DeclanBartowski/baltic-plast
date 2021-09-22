<?
$arLibs = [
    $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/defines.php',
];

foreach ($arLibs as $lib) {
    if (file_exists($lib)) {
        require_once($lib);
    }
}
\Bitrix\Main\Loader::registerAutoLoadClasses(null, [
    'DDS\\Tools' => '/local/php_interface/include/DDSShopAPI/classes/tools.php',
    'DDS\\Basketclass' => '/local/php_interface/include/DDSShopAPI/classes/basket.php',
    'DDS\\Date' => '/local/php_interface/include/DDSShopAPI/classes/date.php',
]);

function getParent($id)
{
    $tt = CIBlockSection::GetList(array(), array('ID' => $id));
    $as = $tt->GetNext();
    static $a;
    if ($as['DEPTH_LEVEL'] == 1) {
        $a = $as['ID'];
    } else {
        getParent($as['IBLOCK_SECTION_ID']);
    }
    return $a;
}

function getUrl()
{
    $url = @($_SERVER["HTTPS"] != 'on') ? 'http://' . $_SERVER["SERVER_NAME"] : 'https://' . $_SERVER["SERVER_NAME"];
    $url .= ($_SERVER["SERVER_PORT"] != 80) ? ":" . $_SERVER["SERVER_PORT"] : "";
    //$url .= $_SERVER["REQUEST_URI"];
    return $url;
}

AddEventHandler("sale", "OnOrderNewSendEmail", "ModifyOrderSaleMails");
function ModifyOrderSaleMails($orderID, &$eventName, &$arFields)
{
    if (CModule::IncludeModule("sale") && CModule::IncludeModule("iblock")) {
        if (SITE_ID == 's1') {
            $productTitle = 'Товар';
            $summTitle = 'Сумма';
            $quantityTitle = 'Кол-во';
            $weightSumTitle = 'Общий вес';
            $productsSumTitle = 'Товаров на сумму';
            $deliveryPriceTitle = 'Стоимость доставки';
            $resultPriceTitle = 'Итого';
            $quantityPerOne = 'шт.';
            $curreny = 'RUB';
            $weightType = 'гр.';

        } elseif (SITE_ID == 's3') {
            $productTitle = 'Produkt';
            $summTitle = 'Suma';
            $quantityTitle = 'Ilość';
            $weightSumTitle = 'Całkowita waga';
            $productsSumTitle = 'Wszystkie produkty';
            $deliveryPriceTitle = 'Koszt wysyłki';
            $resultPriceTitle = 'Razem';
            $quantityPerOne = 'szt.';
            $curreny = 'PLN';
            $weightType = 'gr.';

        } else {
            $productTitle = 'Product';
            $summTitle = 'Sum';
            $quantityTitle = 'Quantity';
            $weightSumTitle = 'Total Weight';
            $productsSumTitle = 'Total Products';
            $deliveryPriceTitle = 'Shipping cost';
            $resultPriceTitle = 'Total';
            $quantityPerOne = 'pcs';
            $curreny = 'USD';
            $weightType = 'gr.';
        }

        $productTable = '<table class="product-table" style="margin: 0;padding: 0;box-sizing: border-box;font-family: Arial, serif;border-spacing: 0;width: 547px;margin-left: auto;margin-right: auto;">
				<tr style="margin: 0;padding: 0;box-sizing: border-box;">
					<td class="product-table_first-cell" style="margin: 0;padding: 10px 20px;box-sizing: border-box;width: 63%;border: 1px solid #E9E9E9;vertical-align: top;"><span class="text-subtitle" style="margin: 0;padding: 0;box-sizing: border-box;display: block;color: #919191;">' . $productTitle . '</span></td>
					<td style="margin: 0;padding: 10px 20px;box-sizing: border-box;border: 1px solid #E9E9E9;vertical-align: top;"><span class="text-subtitle" style="margin: 0;padding: 0;box-sizing: border-box;display: block;color: #919191;">' . $summTitle . '</span></td>
					<td style="margin: 0;padding: 10px 20px;box-sizing: border-box;border: 1px solid #E9E9E9;vertical-align: top;"><span class="text-subtitle" style="margin: 0;padding: 0;box-sizing: border-box;display: block;color: #919191;">' . $quantityTitle . '</span></td>
				</tr>';


        $order = Bitrix\Sale\Order::load($orderID);


        $productsSum = 0;
        $deliveryPrice = $order->getDeliveryPrice();
        $resultSum = $order->getPrice();
        $basket = $order->getBasket();
        $weightSum = floatval($basket->getWeight());

        $arProducts = [];
        foreach ($basket as $basketItem) {
            $arProducts[] = $basketItem->getProductId();
        }

        if (!empty($arProducts)) {
            $select = Array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_*');
            $filter = Array('ID' => $arProducts, 'ACTIVE_DATE' => 'Y', 'ACTIVE' => 'Y');
            $res = CIBlockElement::GetList(Array(), $filter, false, false, $select);
            while ($ob = $res->GetNextElement()) {
                $fields = $ob->GetFields();
                $fields ['PROPERTIES'] = $ob->GetProperties();
                $arProductsData[$fields['ID']] = $fields;
            }
        }

        foreach ($basket as $basketItem) {
            $arProductData = $arProductsData[$basketItem->getProductId()];
            $productsSum += $basketItem->getFinalPrice();
            $arFileTmp = CFile::ResizeImageGet(
                $arProductData['PREVIEW_PICTURE'],
                ['width' => 57, 'height' => 54],
                BX_RESIZE_IMAGE_PROPORTIONAL
            );

            $productTable .= '<tr style="margin: 0;padding: 0;box-sizing: border-box;">
					<td class="product-table_first-cell" style="margin: 0;padding: 10px 20px;box-sizing: border-box;width: 63%;border: 1px solid #E9E9E9;vertical-align: top;">
						<table class="product-table_inner" style="margin: 0;padding: 0;box-sizing: border-box;font-family: Arial, serif;border-spacing: 0;width: 100%;font-size: 13px;">
							<tr style="margin: 0;padding: 0;box-sizing: border-box;">
								<td class="product_cell-img" style="margin: 0;padding: 0 !important;box-sizing: border-box;border: none;vertical-align: top;">
									<div class="product-img" style="margin: 0;padding: 0;box-sizing: border-box;">
										<img src="' . getUrl() . '' . $arFileTmp['src'] . '" alt="' . $basketItem->getField('NAME') . '" style="margin: 0;padding: 0;box-sizing: border-box;max-width: 100%;">
									</div>
								</td>
								<td class="product_cell-desc" style="margin: 0;padding: 10px 20px;box-sizing: border-box;border: none;vertical-align: top;padding-right: 0 !important;">
									<span class="product-title" style="margin: 0;padding: 0;box-sizing: border-box;font-weight: 700;display: block;margin-bottom: 4px;">' . $basketItem->getField('NAME') . '</span>
									<table class="product-features" style="margin: 0;padding: 0;box-sizing: border-box;font-family: Arial, serif;border-spacing: 0;width: 100%;">
									';
            foreach ($arProductData['PROPERTIES']['CHARS']['VALUE'] as $key => $val) {
                $productTable .= '<tr style="margin: 0;padding: 0;box-sizing: border-box;">
											<td style="margin: 0;padding: 2px;box-sizing: border-box;border: none;vertical-align: top;">' . $val . '</td>
											<td class="bold-text" style="margin: 0;padding: 2px;box-sizing: border-box;font-weight: 700;border: none;vertical-align: top;">' . $arProductData['PROPERTIES']['CHARS']['DESCRIPTION'][$key] . ' </td>
										</tr>';
            }
            $productTable .= '</table>
								</td>
							</tr>
						</table>
					</td>
					<td class="bold-text" style="margin: 0;padding: 10px 20px;box-sizing: border-box;font-weight: 700;border: 1px solid #E9E9E9;vertical-align: top;">' . CurrencyFormat($basketItem->getFinalPrice(),
                    $curreny) . '</td>
					<td class="bold-text" style="margin: 0;padding: 10px 20px;box-sizing: border-box;font-weight: 700;border: 1px solid #E9E9E9;vertical-align: top;">' . $basketItem->getQuantity() . ' ' . $quantityPerOne . '</td>
				</tr>';
        }

        $productsSum = CurrencyFormat($productsSum, $curreny);
        $deliveryPrice = CurrencyFormat($deliveryPrice, $curreny);
        $resultSum = CurrencyFormat($resultSum, $curreny);


        $productTable .= '<tr style="margin: 0;padding: 0;box-sizing: border-box;">
					<td class="product-total_left-cell" style="margin: 0;padding: 10px 20px;box-sizing: border-box;border: 1px solid #E9E9E9;vertical-align: top;border-right: none !important;padding-bottom: 20px !important;">
						<table class="product_total-table" style="margin: 0;padding: 0;box-sizing: border-box;font-family: Arial, serif;border-spacing: 0;width: auto;font-size: 13px;">
							<tr style="margin: 0;padding: 0;box-sizing: border-box;">
								<td style="margin: 0;padding: 4px;box-sizing: border-box;border: none;vertical-align: top;">' . $weightSumTitle . '</td>
								<td class="bold-text" style="margin: 0;padding: 4px;box-sizing: border-box;font-weight: 700;border: none;vertical-align: top;">' . $weightSum . ' ' . $weightType . '</td>
							</tr>
							<tr style="margin: 0;padding: 0;box-sizing: border-box;">
								<td style="margin: 0;padding: 4px;box-sizing: border-box;border: none;vertical-align: top;">' . $productsSumTitle . '</td>
								<td class="bold-text" style="margin: 0;padding: 4px;box-sizing: border-box;font-weight: 700;border: none;vertical-align: top;">' . $productsSum . '</td>
							</tr>
							<tr style="margin: 0;padding: 0;box-sizing: border-box;">
								<td style="margin: 0;padding: 4px;box-sizing: border-box;border: none;vertical-align: top;">' . $deliveryPriceTitle . '</td>
								<td class="bold-text" style="margin: 0;padding: 4px;box-sizing: border-box;font-weight: 700;border: none;vertical-align: top;">' . $deliveryPrice . '</td>
							</tr>
						</table>
					</td>
					<td colspan="2" class="text-right vertical-end product-total_right-cell" style="margin: 0;padding: 10px 20px;box-sizing: border-box;text-align: right;border: 1px solid #E9E9E9;vertical-align: bottom !important;border-left: none !important;padding-bottom: 20px !important;">
						<div class="product_total-price" style="margin: 0;padding: 0;box-sizing: border-box;font-weight: 700;">
							' . $resultPriceTitle . ' <span class="product_total-sum" style="margin: 0;padding: 0;box-sizing: border-box;margin-left: 12px;"> ' . $resultSum . '</span>
						</div>
					</td>
				</tr>
			</table>';

        $arFields["PRODUCTS_TABLE"] = $productTable;

        $propertyCollection = $order->getPropertyCollection();
        $arProperties = $propertyCollection->getArray();
        foreach ($arProperties as $arGroup) {
            foreach ($arGroup as $arProp) {
                $arFields[$arProp['CODE']] = $arProp['VALUE'][0];
            }
        }
        $arFields['USER_FULL_NAME'] = sprintf('%s %s %s', $arFields['LAST_NAME'], $arFields['NAME'],
            $arFields['SECOND_NAME']);
        $arFields['SITE_DIR'] = SITE_DIR;

    }
}