<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
<? $APPLICATION->IncludeComponent(
	"2quick:contacts", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"TITLE" => "Главный офис продаж",
		"SUBTITLE" => "Пишите, звоните, приезжайте!",
		"PHONES" => array(
			0 => "+7 (555) 55-55-55",
			1 => "8-800-00-00-00",
			2 => "",
		),
		"ADDRESSES" => "236039, Калининградская область, г. Калининград, ул. Суворова, д.35Б, корп.6",
		"EMAIL" => array(
			0 => "Order@balticplast.ru",
			1 => "Info@balticplast.ru",
			2 => "Export@balticplast.ru",
			3 => "",
		),
		"EMAIL_DESCRIPTION" => array(
			0 => "Вопросы по заказам, для предварительного запроса по ценам и ассортименту",
			1 => "Общие вопросы, <span class=\"min\">вопросы рекламации.</span>",
			2 => "Все вопросы по <span class=\"min\">экспортным отгрузкам</span>",
			3 => "",
		),
		"MAP_COORDS" => "55.61576156912312, 37.208299999999994",
		"MAP_BALLOONS" => "Калининградская область, г. Калининград, <br /> ул. Суворова, д.35Б, корп.6"
	),
	false
); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>