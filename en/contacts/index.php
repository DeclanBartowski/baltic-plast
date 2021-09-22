<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Contacts");
?>
<? $APPLICATION->IncludeComponent(
    "2quick:contacts",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "TITLE" => "Main sales office",
        "SUBTITLE" => "Write, call, come!",
        "PHONES" => array(
            0 => "+7 (555) 55-55-55",
            1 => "8-800-00-00-00",
            2 => "",
        ),
        "ADDRESSES" => "236039, Kaliningrad region, Kaliningrad, st. Suvorov, 35B, building 6",
        "EMAIL" => array(
            0 => "Order@balticplast.ru",
            1 => "Info@balticplast.ru",
            2 => "Export@balticplast.ru",
            3 => "",
        ),
        "EMAIL_DESCRIPTION" => array(
            0 => "Questions about orders, for a preliminary inquiry on prices and assortment",
            1 => "General questions, <span class = \"min\"> complaint questions. </span>",
            2 => "All questions about <span class = \"min\"> export shipments </span>",
            3 => "",
        ),
        "MAP_COORDS" => "55.61576156912312, 37.208299999999994",
        "MAP_BALLOONS" => "Kaliningrad region, Kaliningrad, <br /> st. Suvorov, 35B, building 6"
    ),
    false
); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>