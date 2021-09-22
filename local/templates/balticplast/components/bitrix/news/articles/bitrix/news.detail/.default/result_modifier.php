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

if (!empty($arResult['PROPERTIES']['SLIDER']['VALUE'])) {
    foreach ($arResult['PROPERTIES']['SLIDER']['VALUE'] as $key => $intPicID) {
        $arResult['SLIDER'][] = [
            'SRC' => CFile::GetPath($intPicID),
            'DESCRIPTION' => $arResult['PROPERTIES']['SLIDER']['DESCRIPTION'][$key]
        ];
    }
}
