<?php

use \Bitrix\Catalog\CatalogViewedProductTable as CatalogViewedProductTable;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

global $APPLICATION;
global $USER;
$user_id = CUser::GetID();
if ($user_id > 0) {
    $product_id = $arResult['ID'];
    CatalogViewedProductTable::refresh($product_id, $user_id);
}
