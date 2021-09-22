<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arResult["PRICE_REFORMATED"] = CurrencyFormat(0, $arResult['MIN_PRICE']['CURRENCY']);
$arResult["PRICE_REFORMATED"] = sprintf('%s %s</small>', str_replace(0,
    sprintf('%s <small>', $arResult["MIN_PRICE"]['DISCOUNT_VALUE_VAT']),
    $arResult["PRICE_REFORMATED"]
), $arResult['ITEM_MEASURE']['TITLE']);

if (!empty($arResult['PROPERTIES']['SLIDER']['VALUE'])) {
    foreach ($arResult['PROPERTIES']['SLIDER']['VALUE'] as $intPicID) {
        $arFileTmp = CFile::ResizeImageGet(
            $intPicID,
            ['width' => 293, 'height' => 367],
            BX_RESIZE_IMAGE_PROPORTIONAL
        );
        $arFileTmpSmall = CFile::ResizeImageGet(
            $intPicID,
            ['width' => 57, 'height' => 69],
            BX_RESIZE_IMAGE_PROPORTIONAL
        );
        $arResult['SLIDER'][] = [
            'SRC' => $arFileTmp['src'],
            'FULL' => CFile::GetPath($intPicID),
            'SMALL' => $arFileTmpSmall['src'],
        ];
    }
}

$arResult['LENGTH'] = [
    'NUM' => preg_replace('/[^\d]/', '', $arResult['PROPERTIES']['LENGTH']['VALUE']),
    'MEASURE' => preg_replace('/[^a-zA-Zа-яА-Я.]/ui', '', $arResult['PROPERTIES']['LENGTH']['VALUE'])
];