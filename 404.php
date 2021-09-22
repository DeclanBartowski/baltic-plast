<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");
$APPLICATION->SetPageProperty('main_content', 'main-content_error');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found"); ?>
    <div class="wrapper_head-logo">
        <div class="head-logo">
            <a href="<?= SITE_DIR ?>">
                <img data-src="<?= SITE_TEMPLATE_PATH ?>/img/static/logo-2.svg" alt="alt">
            </a>
        </div>
    </div>
    <div class="error-section">
        <div class="container">
            <div class="error-bg"></div>
            <? $APPLICATION->IncludeFile(
                sprintf("/include%s404-text.php", SITE_DIR),
                array(),
                array("MODE" => "php")
            ); ?>
        </div>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>