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


if (!empty($arParams['TITLE'])) {
    $arResult['TITLE'] = $arParams['TITLE'];
}
if (!empty($arParams['SUBTITLE'])) {
    $arResult['SUBTITLE'] = $arParams['SUBTITLE'];
}
if (!empty($arParams['PHONES'])) {
    foreach ($arParams['PHONES'] as $phone) {
        if (!empty($phone)) {
            $arResult['PHONES'][] = array('FORMATED' => $phone, 'PHONE' => preg_replace('~\D+~', '', $phone));
        }
    }
}
if (!empty($arParams['ADDRESSES'])) {
    $arResult['ADDRESS'] = $arParams['ADDRESSES'];
}
if (!empty($arParams['EMAIL'])) {
    foreach ($arParams['EMAIL'] as $key => $email) {
        if (!empty($email)) {
            $arResult['EMAILS'][] = [
                'EMAIL' => $email,
                'DESCRIPTION' => htmlspecialchars_decode($arParams['EMAIL_DESCRIPTION'][$key])
            ];
        }
    }
};

if (!empty($arParams['MAP_COORDS'])) {
    $arResult['MAP_COORDS'] = $arParams['MAP_COORDS'];
}
if (!empty($arParams['MAP_BALLOONS'])) {
    $arResult['MAP_BALLOONS'] = htmlspecialchars_decode($arParams['MAP_BALLOONS']);
}

$this->IncludeComponentTemplate();
?>
