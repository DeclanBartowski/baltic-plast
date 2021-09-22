<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */

/** @var array $arResult */

use Bitrix\Main;

$defaultParams = array(
    'TEMPLATE_THEME' => 'blue'
);
$arParams = array_merge($defaultParams, $arParams);
unset($defaultParams);

$arParams['TEMPLATE_THEME'] = (string)($arParams['TEMPLATE_THEME']);
if ('' != $arParams['TEMPLATE_THEME']) {
    $arParams['TEMPLATE_THEME'] = preg_replace('/[^a-zA-Z0-9_\-\(\)\!]/', '', $arParams['TEMPLATE_THEME']);
    if ('site' == $arParams['TEMPLATE_THEME']) {
        $templateId = (string)Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', SITE_ID);
        $templateId = (preg_match("/^eshop_adapt/", $templateId)) ? 'eshop_adapt' : $templateId;
        $arParams['TEMPLATE_THEME'] = (string)Main\Config\Option::get('main', 'wizard_' . $templateId . '_theme_id',
            'blue', SITE_ID);
    }
    if ('' != $arParams['TEMPLATE_THEME']) {
        if (!is_file($_SERVER['DOCUMENT_ROOT'] . $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css')) {
            $arParams['TEMPLATE_THEME'] = '';
        }
    }
}
if ('' == $arParams['TEMPLATE_THEME']) {
    $arParams['TEMPLATE_THEME'] = 'blue';
}

use Bitrix\Main\Grid\Declension;

$productsDeclension = new Declension(GetMessage('TQ_BASKET_PRODUCTS_DEC_ONE'), GetMessage('TQ_BASKET_PRODUCTS_DEC_TWO'),
    GetMessage('TQ_BASKET_PRODUCTS_DEC_MANY'));
$count = count($arResult['ITEMS']['AnDelCanBuy']);
$arResult['PRODUCTS_COUNT_FORMATED'] = sprintf('%s %s', $count, $productsDeclension->get($count));


function tqBasketSearch(&$item, $key, $query)
{
    if (mb_stripos($item['NAME'], $query) !== false) {
        $item['SEARCHED'] = 'Y';
    }
}

$query = $_REQUEST['q'];
if (!empty($query)) {
    $arResult['SEARCH'] = "Y";
    array_walk($arResult['ITEMS']['AnDelCanBuy'], 'tqBasketSearch', $query);
}
foreach ($arResult['ITEMS']['AnDelCanBuy'] as &$item) {
    $item['LENGTH'] = [
        'NUM' => preg_replace('/[^\d]/', '', $item['PROPERTY_LENGTH_VALUE']),
        'MEASURE' => preg_replace('/[^a-zA-Zа-яА-Я.]/ui', '', $item['PROPERTY_LENGTH_VALUE'])
    ];
}
unset($item);

//$arResult['PG_M_CONST'] = PG_M_CONST;
