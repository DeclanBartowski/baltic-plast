<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

if ($arParams['SHOW_PRIVATE_PAGE'] !== 'Y') {
    LocalRedirect($arParams['SEF_FOLDER']);
}

if ($arParams["MAIN_CHAIN_NAME"] <> '') {
    $APPLICATION->AddChainItem(htmlspecialcharsbx($arParams["MAIN_CHAIN_NAME"]), $arResult['SEF_FOLDER']);
}
$APPLICATION->AddChainItem(Loc::getMessage("SPS_CHAIN_PRIVATE"));
if ($arParams['SET_TITLE'] == 'Y') {
    $APPLICATION->SetTitle(Loc::getMessage("SPS_TITLE_PRIVATE"));
}

?>
<div class="personal-area_section">
	<div class="container">
		<ul class="breadcrumbs">
            <? $APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "breadcrumbs",
                Array(
                    "ADDITIONAL_CLASS" => " breadcrumbs-mod",
                    "PATH" => "",
                    "SITE_ID" => SITE_ID,
                    "START_FROM" => "0"
                )
            ); ?>
		</ul>
		<h1><?= $APPLICATION->ShowTitle(false); ?></h1>
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.profile",
            "",
            Array(
                "CAN_EDIT_PASSWORD" => $_REQUEST['change_password'],
                "SET_TITLE" => $arParams["SET_TITLE"],
                "AJAX_MODE" => $arParams['AJAX_MODE_PRIVATE'],
                "SEND_INFO" => $arParams["SEND_INFO_PRIVATE"],
                "CHECK_RIGHTS" => $arParams['CHECK_RIGHTS_PRIVATE'],
                "EDITABLE_EXTERNAL_AUTH_ID" => $arParams['EDITABLE_EXTERNAL_AUTH_ID'],
            ),
            $component
        ); ?>
	</div>
</div>
<!-- end unidied-inner_section -->
