<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


if (!empty($arParams['PHONE'])) {
    $arResult['PHONE'] = array(
        'FORMATED' => $arParams['PHONE'],
        'PHONE' => preg_replace('~\D+~', '', $arParams['PHONE'])
    );
}
if (!empty($arParams['EMAIL'])) {
    $arResult['EMAIL'] = $arParams['EMAIL'];
}
if (!empty($arParams['INST'])) {
    $arResult['INST'] = $arParams['INST'];
}
if (!empty($arParams['VK'])) {
    $arResult['VK'] = $arParams['VK'];
}
if (!empty($arParams['YOUTUBE'])) {
    $arResult['YOUTUBE'] = $arParams['YOUTUBE'];
}
if (!empty($arParams['FACEBOOK'])) {
    $arResult['FACEBOOK'] = $arParams['FACEBOOK'];
}
if (!empty($arParams['PATH_TO_PERSONAL'])) {
    $arResult['PATH_TO_PERSONAL'] = $arParams['PATH_TO_PERSONAL'];
}

$rsSites = CSite::GetList($by = "sort", $order = "desc", Array());
while ($arSite = $rsSites->Fetch()) {
    $arResult['SITES'][$arSite['ID']] = $arSite;
}
$arResult['CURRENT_SITE'] = $arResult['SITES'][SITE_ID];

$this->IncludeComponentTemplate();
?>
