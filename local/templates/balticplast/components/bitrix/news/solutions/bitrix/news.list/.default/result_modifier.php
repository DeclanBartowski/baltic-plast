<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */


foreach ($arResult['ITEMS'] as &$arItem) {
    if (!empty($arItem['PROPERTIES']['SLIDER']['VALUE'])) {
        foreach ($arItem['PROPERTIES']['SLIDER']['VALUE'] as $intPicID) {
            $arItem['SLIDER'][] = CFile::GetPath($intPicID);
        }
    }
}

unset($arItem);
