<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arParams
 * @var array $arResult
 * @var SaleOrderAjax $component
 */

$component = $this->__component;
$component::scaleImages($arResult['JS_DATA'], $arParams['SERVICES_IMAGES_SCALING']);

if ($USER->IsAuthorized()) {
    $filter = Array('ID' => $USER->GetID());
    $res = Bitrix\Main\UserTable::getList(Array(
        'select' => Array(
            'NAME',
            'EMAIL',
            'LAST_NAME',
            'SECOND_NAME',
            'PERSONAL_PHONE',
            'WORK_COMPANY',
            'PERSONAL_STREET',
            'UF_*'
        ),
        'filter' => $filter,
    ));
    while ($arRes = $res->fetch()) {
        $arResult['USER_INFO'] = $arRes;
    }
}

