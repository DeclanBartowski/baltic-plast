<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Łączność");
?>
<? $APPLICATION->IncludeComponent(
    "2quick:contacts",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "TITLE" => "Główne biuro sprzedaży",
        "SUBTITLE" => "Napisz, zadzwoń, przyjdź!",
        "PHONES" => array(
            0 => "+7 (555) 55-55-55",
            1 => "8-800-00-00-00",
            2 => "",
        ),
        "ADDRESSES" => "236039, Obwód Kaliningradzki, Kaliningrad, ul. Suworow, 35B, budynek 6",
        "EMAIL" => array(
            0 => "Order@balticplast.ru",
            1 => "Info@balticplast.ru",
            2 => "Export@balticplast.ru",
            3 => "",
        ),
        "EMAIL_DESCRIPTION" => array(
            0 => "Pytania dotyczące zamówień, wstępne zapytanie o ceny i asortyment",
            1 => "Pytania ogólne, <span class = \"min\"> pytania reklamacyjne. </span>",
            2 => "Wszystkie pytania dotyczące <span class = \"min\"> przesyłek eksportowych </span>",
            3 => "",
        ),
        "MAP_COORDS" => "55.61576156912312, 37.208299999999994",
        "MAP_BALLOONS" => "Obwód Kaliningradzki, Kaliningrad, <br /> ul. Suworow, 35B, budynek 6"
    ),
    false
); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>