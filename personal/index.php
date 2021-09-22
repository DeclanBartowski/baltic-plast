<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
if (!$USER->IsAuthorized()) {
    LocalRedirect(SITE_DIR);
}
$APPLICATION->SetTitle("Личный кабинет");
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:sale.personal.section",
    "personal-area",
    array(
        "ACCOUNT_PAYMENT_SELL_USER_INPUT" => "N",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "CHECK_RIGHTS_PRIVATE" => "N",
        "COMPATIBLE_LOCATION_MODE_PROFILE" => "N",
        "CUSTOM_PAGES" => "",
        "CUSTOM_SELECT_PROPS" => array(),
        "MAIN_CHAIN_NAME" => "",
        "NAV_TEMPLATE" => "",
        "ORDERS_PER_PAGE" => "99999",
        "ORDER_DEFAULT_SORT" => "STATUS",
        "ORDER_DISALLOW_CANCEL" => "N",
        "ORDER_HIDE_USER_INFO" => array(
            0 => "0",
        ),
        "ORDER_HISTORIC_STATUSES" => array(
            0 => "F",
        ),
        "ORDER_REFRESH_PRICES" => "N",
        "ORDER_RESTRICT_CHANGE_PAYSYSTEM" => array(
            0 => "F",
        ),
        "PATH_TO_BASKET" => SITE_DIR . "basket/",
        "PATH_TO_CATALOG" => SITE_DIR . "catalog/",
        "PATH_TO_CONTACT" => SITE_DIR . "contacts/",
        "PATH_TO_PAYMENT" => SITE_DIR . "personal/order/payment/",
        "PROFILES_PER_PAGE" => "20",
        "PROP_1" => array(),
        "SAVE_IN_SESSION" => "Y",
        "SEF_FOLDER" => SITE_DIR . "personal/",
        "SEF_MODE" => "Y",
        "SEND_INFO_PRIVATE" => "N",
        "SET_TITLE" => "Y",
        "SHOW_ACCOUNT_PAGE" => "N",
        "SHOW_BASKET_PAGE" => "N",
        "SHOW_CONTACT_PAGE" => "N",
        "SHOW_ORDER_PAGE" => "Y",
        "SHOW_PRIVATE_PAGE" => "Y",
        "SHOW_PROFILE_PAGE" => "N",
        "SHOW_SUBSCRIBE_PAGE" => "N",
        "USE_AJAX_LOCATIONS_PROFILE" => "N",
        "COMPONENT_TEMPLATE" => "personal-area",
        "SEF_URL_TEMPLATES" => array(
            "index" => "index.php",
            "orders" => "orders/",
            "account" => "",
            "subscribe" => "",
            "profile" => "",
            "profile_detail" => "profiles/#ID#",
            "private" => "data/",
            "order_detail" => "orders/#ID#",
            "order_cancel" => "cancel/#ID#",
        )
    ),
    false
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>