<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Szukaj");
?><? $APPLICATION->IncludeComponent(
    "bitrix:catalog.search",
    "search",
    array(
        "ACTION_VARIABLE" => "action",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "BASKET_URL" => "/personal/basket.php",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "N",
        "CONVERT_CURRENCY" => "N",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_COMPARE" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER2" => "desc",
        "HIDE_NOT_AVAILABLE" => "N",
        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
        "IBLOCK_ID" => IBLOCK_CATALOG_ID,
        "IBLOCK_TYPE" => IBLOCK_CONTENT_TYPE,
        "LINE_ELEMENT_COUNT" => "3",
        "NO_WORD_LOGIC" => "N",
        "OFFERS_LIMIT" => "5",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "modern",
        "PAGER_TITLE" => "Товары",
        "PAGE_ELEMENT_COUNT" => "16",
        "PRICE_CODE" => array(
            0 => "BASE",
        ),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPERTIES" => array(),
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "RESTART" => "Y",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "SECTION_URL" => "",
        "SHOW_PRICE_COUNT" => "1",
        "USE_LANGUAGE_GUESS" => "Y",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
        "USE_SEARCH_RESULT_ORDER" => "N",
        "USE_TITLE_RANK" => "N",
        "COMPONENT_TEMPLATE" => "search"
    ),
    false
); ?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>