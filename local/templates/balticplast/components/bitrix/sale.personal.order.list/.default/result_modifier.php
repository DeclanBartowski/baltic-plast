<?

foreach ($arResult['ORDERS'] as $order) {
    foreach ($order['BASKET_ITEMS'] as $arItem) {
        $arProducts[] = $arItem['PRODUCT_ID'];
    }
}

$select = Array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_ARTNUMBER');
$filter = Array('ID' => $arProducts);
$res = CIBlockElement::GetList(Array(), $filter, false, false, $select);
while ($arItem = $res->Fetch()) {
    $arFileTmp = CFile::ResizeImageGet(
        $arItem['PREVIEW_PICTURE'],
        ['width' => 75, 'height' => 50],
        BX_RESIZE_IMAGE_PROPORTIONAL
    );
    $arResult['PRODUCTS'][$arItem['ID']] = [
        'PICTURE' => $arFileTmp['src'],
        'ARTNUMBER' => $arItem['PROPERTY_ARTNUMBER_VALUE']
    ];
}

foreach ($arResult['ORDERS'] as &$order) {
    foreach ($order['BASKET_ITEMS'] as &$arItem) {
        if (!empty($arResult['PRODUCTS'][$arItem['PRODUCT_ID']])) {
            $arItem['PRODUCT_INFO'] = $arResult['PRODUCTS'][$arItem['PRODUCT_ID']];
        }
    }
}
unset($order, $arItem);
?>