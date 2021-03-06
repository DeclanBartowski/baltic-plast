<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Sale;

?>
<? $APPLICATION->IncludeComponent(
    "bitrix:sale.basket.basket",
    ".default",
    Array(
        "ACTION_VARIABLE" => "basketAction",
        "ADDITIONAL_PICT_PROP_3" => "-",
        "AUTO_CALCULATION" => "Y",
        "BASKET_IMAGES_SCALING" => "adaptive",
        "COLUMNS_LIST_EXT" => array(
            0 => "PREVIEW_PICTURE",
            1 => "DETAIL_PICTURE",
            2 => "PREVIEW_TEXT",
            3 => "DISCOUNT",
            4 => "WEIGHT",
            5 => "PROPS",
            6 => "DELETE",
            7 => "DELAY",
            8 => "TYPE",
            9 => "SUM",
            10 => "PROPERTY_COMPLECT_TYPE",
            11 => "PROPERTY_COLOR",
            12 => "PROPERTY_DIAM",
            13 => "PROPERTY_MANUFACTURER",
            14 => "PROPERTY_SLIDER",
            15 => "PROPERTY_LENGTH",
            16 => "PROPERTY_ARTNUMBER",
            17 => "PROPERTY_CHARS",
            18 => "PROPERTY_MINIMUM",
        ),
        "COLUMNS_LIST_MOBILE" => array(
            0 => "PREVIEW_PICTURE",
            1 => "DETAIL_PICTURE",
            2 => "PREVIEW_TEXT",
            3 => "DISCOUNT",
            4 => "WEIGHT",
            5 => "PROPS",
            6 => "DELETE",
            7 => "DELAY",
            8 => "TYPE",
            9 => "SUM",
            10 => "PROPERTY_COMPLECT_TYPE",
            11 => "PROPERTY_COLOR",
            12 => "PROPERTY_DIAM",
            13 => "PROPERTY_MANUFACTURER",
            14 => "PROPERTY_SLIDER",
            15 => "PROPERTY_LENGTH",
            16 => "PROPERTY_ARTNUMBER",
            17 => "PROPERTY_CHARS",
            18 => "PROPERTY_MINIMUM",
        ),
        "COMPATIBLE_MODE" => "Y",
        "COMPONENT_TEMPLATE" => ".default",
        "CORRECT_RATIO" => "Y",
        "DEFERRED_REFRESH" => "N",
        "DISCOUNT_PERCENT_POSITION" => "bottom-right",
        "DISPLAY_MODE" => "extended",
        "EMPTY_BASKET_HINT_PATH" => "/catalog/",
        "GIFTS_BLOCK_TITLE" => "???????????????? ???????? ???? ????????????????",
        "GIFTS_CONVERT_CURRENCY" => "N",
        "GIFTS_HIDE_BLOCK_TITLE" => "N",
        "GIFTS_HIDE_NOT_AVAILABLE" => "N",
        "GIFTS_MESS_BTN_BUY" => "??????????????",
        "GIFTS_MESS_BTN_DETAIL" => "??????????????????",
        "GIFTS_PAGE_ELEMENT_COUNT" => "4",
        "GIFTS_PLACE" => "BOTTOM",
        "GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
        "GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
        "GIFTS_SHOW_OLD_PRICE" => "N",
        "GIFTS_TEXT_LABEL_GIFT" => "??????????????",
        "HIDE_COUPON" => "N",
        "LABEL_PROP" => array(),
        "PATH_TO_ORDER" => "/order/",
        "PRICE_DISPLAY_MODE" => "Y",
        "PRICE_VAT_SHOW_VALUE" => "N",
        "PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
        "QUANTITY_FLOAT" => "Y",
        "SET_TITLE" => "N",
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "SHOW_FILTER" => "N",
        "SHOW_RESTORE" => "Y",
        "TEMPLATE_THEME" => "blue",
        "TOTAL_BLOCK_DISPLAY" => array(0 => "top",),
        "USE_DYNAMIC_SCROLL" => "Y",
        "USE_ENHANCED_ECOMMERCE" => "N",
        "USE_GIFTS" => "N",
        "USE_PREPAYMENT" => "N",
        "USE_PRICE_ANIMATION" => "Y"
    )
); ?>