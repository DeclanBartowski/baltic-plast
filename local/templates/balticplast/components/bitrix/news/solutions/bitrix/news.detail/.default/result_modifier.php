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
        $arFileTmp = CFile::ResizeImageGet(
            $intPicID,
            ['width' => 540, 'height' => 540],
            BX_RESIZE_IMAGE_PROPORTIONAL
        );
        $arFileTmpSmall = CFile::ResizeImageGet(
            $intPicID,
            ['width' => 89, 'height' => 84],
            BX_RESIZE_IMAGE_PROPORTIONAL
        );
        $arResult['SLIDER'][] = [
            'SRC' => $arFileTmp['src'],
            'SMALL' => $arFileTmpSmall['src'],
            'FULL' => CFile::GetPath($intPicID),
            'DESCRIPTION' => $arResult['PROPERTIES']['SLIDER']['DESCRIPTION'][$key]
        ];
    }
}

if (!empty($arResult['PROPERTIES']['PRODUCTS']['VALUE'])) {
    if (CModule::IncludeModule("catalog")) {
        $res_measure = CCatalogMeasure::getList();
        while ($measure = $res_measure->Fetch()) {
            $arResult['MEASURES'][$measure['ID']] = $measure;
        }
    }

    $select = Array(
        'ID',
        'IBLOCK_ID',
        'NAME',
        'PREVIEW_PICTURE',
        'DETAIL_PAGE_URL',
        'PROPERTY_ARTNUMBER',
        'PROPERTY_MINIMUM',
        'PROPERTY_LENGTH',
        'CATALOG_PRICE_1'
    );
    $filter = Array(
        'IBLOCK_ID' => $arResult['PROPERTIES']['PRODUCTS']['LINK_IBLOCK_ID'],
        'ID' => $arResult['PROPERTIES']['PRODUCTS']['VALUE'],
        'ACTIVE_DATE' => 'Y',
        'ACTIVE' => 'Y'
    );
    $res = CIBlockElement::GetList(Array(), $filter, false, false, $select);
    while ($fields = $res->GetNext()) {
        $arFileTmp = CFile::ResizeImageGet(
            $fields['PREVIEW_PICTURE'],
            ['width' => 73, 'height' => 69],
            BX_RESIZE_IMAGE_PROPORTIONAL
        );

        $fields['PREVIEW_PICTURE'] = $arFileTmp['src'];

        $fields['PRICE'] = CCatalogProduct::GetOptimalPrice($fields['ID'], 1, $USER->GetUserGroupArray(), 'N', [],
            SITE_ID);
        $fields['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE'] = CCurrencyRates::ConvertCurrency($fields['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE'],
            $fields['PRICE']['RESULT_PRICE']['CURRENCY'], $fields['PRICE']['PRICE']['CURRENCY']);
        $fields['PRICE']['RESULT_PRICE']['DISCOUNT'] = CCurrencyRates::ConvertCurrency($fields['PRICE']['RESULT_PRICE']['DISCOUNT'],
            $fields['PRICE']['RESULT_PRICE']['CURRENCY'], $fields['PRICE']['PRICE']['CURRENCY']);

        $fields['PRICE']['FORMATED_PRICE'] = CurrencyFormat($fields['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE'], $fields['PRICE']['PRICE']['CURRENCY']);

        if (!empty($fields['CATALOG_MEASURE'])) {
            $fields['MEASURE'] = $arResult['MEASURES'][$fields['CATALOG_MEASURE']];
        }
        $fields['LENGTH'] = [
            'NUM' => preg_replace('/[^\d]/', '', $fields['PROPERTY_LENGTH_VALUE']),
            'MEASURE' => preg_replace('/[^a-zA-Zа-яА-Я.]/ui', '', $fields['PROPERTY_LENGTH_VALUE'])
        ];
        $arResult['PRODUCTS'][] = $fields;
    }
}
