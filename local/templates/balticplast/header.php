<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Page\Asset;

$page = $APPLICATION->GetCurPage();
$GLOBALS['arrPopularFilter']['PROPERTY_POPULAR'] = "Y";
if ($_REQUEST['logout'] == 'yes') {
    $USER->Logout();
    LocalRedirect($APPLICATION->GetCurPage(false));
}
if (\Bitrix\Main\Loader::includeModule('currency'))
{
    \CJSCore::Init(['currency']);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta content="browserconfig.xml" name="msapplication-config"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="<?= SITE_TEMPLATE_PATH ?>/img/favicon.ico" rel="icon" type="image/png"/>
	<link href="<?= SITE_TEMPLATE_PATH ?>/img/favicon.png" rel="icon" type="image/png"/>
	<link rel="apple-touch-icon" sizes="120x120" href="<?= SITE_TEMPLATE_PATH ?>/img/apple-touch-icon.png"/>
    <? $APPLICATION->ShowHead(); ?>
    <? $APPLICATION->ShowPanel(); ?>
	<title><? $APPLICATION->ShowTitle(); ?></title>
	<style>body {
			opacity: 0;
		}</style>
</head>
<body>

<!--[if lt IE 10]>
<p class="browsehappy">
	<?$APPLICATION->IncludeFile(
	"/include".SITE_DIR."old_browser.php",
	Array(),
	Array("MODE"=>"html")
	);?>
</p>
<![endif]-->
<div class="global-wrapper">
	<div class="wrapper-loader">
		<div class="logo-loader"></div>
		<div class="loader-content"></div>
	</div>
	<div class="bg-overlay"></div>
    <? if (ERROR_404 != 'Y') { ?>
		<header class="ui-header">
			<div class="main-head">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:sale.basket.basket.line",
                    "header",
                    Array(
                        "HIDE_ON_BASKET_PAGES" => "N",
                        "PATH_TO_AUTHORIZE" => "",
                        "PATH_TO_BASKET" => SITE_DIR . "basket/",
                        "PATH_TO_ORDER" => SITE_DIR . "order/",
                        "PATH_TO_PERSONAL" => SITE_DIR . "personal/",
                        "PATH_TO_PROFILE" => SITE_DIR . "personal/",
                        "PATH_TO_REGISTER" => SITE_DIR . "login/",
                        "POSITION_FIXED" => "N",
                        "SHOW_AUTHOR" => "N",
                        "SHOW_EMPTY_VALUES" => "Y",
                        "SHOW_NUM_PRODUCTS" => "Y",
                        "SHOW_PERSONAL_LINK" => "Y",
                        "SHOW_PRODUCTS" => "N",
                        "SHOW_REGISTRATION" => "Y",
                        "SHOW_TOTAL_PRICE" => "Y"
                    )
                ); ?>
			</div>
			<div class="head_nav-panel">
				<div class="container">
					<div class="wrapper_form-search">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:search.suggest.input",
                            "search_input",
                            Array(
                                "DROPDOWN_SIZE" => "10",
                                "INPUT_SIZE" => "40",
                                "NAME" => "q",
                                "VALUE" => ""
                            )
                        ); ?>
					</div>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "header",
                        Array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(0 => "",),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "top",
                            "USE_EXT" => "N"
                        )
                    ); ?>
					<div class="head_mobile-box">
                        <? $APPLICATION->IncludeComponent(
                            "2quick:header",
                            "",
                            Array(
                                "EMAIL" => "email@mail.mai",
                                "FACEBOOK" => "https://www.facebook.com/",
                                "INST" => "https://www.instagram.com",
                                "PATH_TO_PERSONAL" => SITE_DIR . "personal/",
                                "PHONE" => "8-800-00-00-00",
                                "VK" => "https://vk.com/",
                                "YOUTUBE" => "https://www.youtube.com/"
                            )
                        ); ?>
					</div>
				</div>
			</div>
		</header>
		<!-- END UI-HEADER -->
    <? } ?>
	<main class="main-content <?= $APPLICATION->GetProperty('main_content') ?>">