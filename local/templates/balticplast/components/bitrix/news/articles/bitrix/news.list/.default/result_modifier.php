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

$filter = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);
$sect = CIBlockSection::GetList(array('sort' => 'asc'), $filter, false, array('UF_*'));
while ($section = $sect->GetNext()) {
    $arResult['SECTIONS'][$section['ID']] = $section;
}

foreach ($arResult['ITEMS'] as &$arItem) {
    $arItem['SECTION'] = $arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']];
}

unset($arItem);
