<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

foreach ($arResult['ITEMS'] as &$arItem) {
    $arItem['TQ_PRICE'] = $arItem['ITEM_PRICES'][key($arItem['ITEM_PRICES'])];
}
unset($arItem);
?>