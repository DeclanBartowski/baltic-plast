<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$sectionLinc = array();
$arResult['ROOT'] = array();
$sectionLinc[0] = &$arResult['ROOT'];
foreach ($arResult['SECTIONS'] as $arSection) {
    $sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']] = $arSection;
    $sectionLinc[$arSection['ID']] = &$sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']];
}
unset($sectionLinc);
?>