<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;


if ($arParams["MAIN_CHAIN_NAME"] <> '') {
    $APPLICATION->AddChainItem(htmlspecialcharsbx($arParams["MAIN_CHAIN_NAME"]), $arResult['SEF_FOLDER']);
}

$this->addExternalCss("/bitrix/css/main/font-awesome.css");
$theme = Bitrix\Main\Config\Option::get("main", "wizard_eshop_bootstrap_theme_id", "blue", SITE_ID);

$availablePages = array();


if ($arParams['SHOW_PRIVATE_PAGE'] === 'Y') {
    $availablePages[] = array(
        "path" => $arResult['PATH_TO_PRIVATE'],
        "name" => Loc::getMessage("SPS_PERSONAL_PAGE_NAME"),
        "icon" => sprintf('%s/img/icons/personal-area/01.svg', SITE_TEMPLATE_PATH)
    );
}

if ($arParams['SHOW_ORDER_PAGE'] === 'Y') {
    $availablePages[] = array(
        "path" => $arResult['PATH_TO_ORDERS'],
        "name" => Loc::getMessage("SPS_ORDER_PAGE_NAME"),
        "icon" => sprintf('%s/img/icons/personal-area/02.svg', SITE_TEMPLATE_PATH)
    );
}

if ($arParams['SHOW_ORDER_PAGE'] === 'Y') {

    $delimeter = ($arParams['SEF_MODE'] === 'Y') ? "?" : "&";
    $availablePages[] = array(
        "path" => $arResult['PATH_TO_ORDERS'] . $delimeter . "filter_history=Y",
        "name" => Loc::getMessage("SPS_ORDER_PAGE_HISTORY"),
        "icon" => sprintf('%s/img/icons/personal-area/03.svg', SITE_TEMPLATE_PATH)
    );
}

if ($arParams['SHOW_PRIVATE_PAGE'] === 'Y') {

    $delimeter = ($arParams['SEF_MODE'] === 'Y') ? "?" : "&";
    $availablePages[] = array(
        "path" => $arResult['PATH_TO_PRIVATE'] . $delimeter . "change_password=Y",
        "name" => Loc::getMessage("SPS_CHANGE_PASSWORD"),
        "icon" => sprintf('%s/img/icons/personal-area/04.svg', SITE_TEMPLATE_PATH)
    );
}


$customPagesList = CUtil::JsObjectToPhp($arParams['~CUSTOM_PAGES']);
if ($customPagesList) {
    foreach ($customPagesList as $page) {
        $availablePages[] = array(
            "path" => $page[0],
            "name" => $page[1],
            "icon" => (mb_strlen($page[2])) ? '<i class="fa ' . htmlspecialcharsbx($page[2]) . '"></i>' : ""
        );
    }
}

if (empty($availablePages)) {
    ShowError(Loc::getMessage("SPS_ERROR_NOT_CHOSEN_ELEMENT"));
} else {
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
			<h1><?=$APPLICATION->ShowTitle(false);?></h1>
			<div class="row">
                <?
                foreach ($availablePages as $blockElement) {
                    ?>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="personal-area_item">
							<a href="<?= htmlspecialcharsbx($blockElement['path']) ?>">
								<span class="item-icon"><img data-src="<?= $blockElement['icon'] ?>" alt="alt"></span>
                                <?= htmlspecialcharsbx($blockElement['name']) ?>
							</a>
						</div>
					</div>
                    <?
                }
                ?>
			</div>
			<a href="?logout=yes" class="main-btn_mod exit_personal-account_btn">
				<span class="ico-arrow"></span> <?=GetMessage('TQ_PERSONAL_AREA_LOGOUT');?>
			</a>
		</div>
	</div>
	<!-- end unidied-inner_section -->
    <?
}
?>
