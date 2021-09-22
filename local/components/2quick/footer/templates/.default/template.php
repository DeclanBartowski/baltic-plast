<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

?>
<div class="container">
	<div class="get-consultation_box">
		<div class="left-column">
			<span class="ico-mail"></span>
            <?= GetMessage('TQ_FOOTER_CONTACTS_ANY_QUESTION'); ?>
		</div>
		<div class="right-column">
			<span class="text"><?= GetMessage('TQ_FOOTER_CONTACTS_CALL_US_TEXT'); ?></span>
			<a href="#callback" data-toggle="modal"
			   class="white-btn"><?= GetMessage('TQ_FOOTER_CONTACTS_GET_CONSULT'); ?>
				<span class="ico-arrow"></span>
			</a>
		</div>
	</div>
	<div class="row no-gutters">
		<div class="col-xl-3 col-lg-4 col-md-4 footer_left-column">
			<div class="footer-logo">
				<a <? if ($APPLICATION->GetCurPage(false) !== SITE_DIR){ ?>href="<?= SITE_DIR ?>"<? } ?>>
					<img data-src="<?= SITE_TEMPLATE_PATH ?>/img/static/logo.svg" alt="alt">
				</a>
			</div>
            <? if (!empty($arResult['SITES'])) { ?>
				<div class="mobile-visible">
					<div class="switch-language footer_switch-language">
						<span class="language-label">
							<span class="ico-globe"></span>
							<?= $arResult['CURRENT_SITE']['LANGUAGE_ID']; ?>
						</span>
						<ul class="switch-language_list">
                            <? foreach ($arResult['SITES'] as $arSite) { ?>
								<li<? if (SITE_ID == $arSite['ID']) { ?> class="active"<? } ?>>
									<a href="<?= $arSite['DIR'] ?>"><?= $arSite['LANGUAGE_ID']; ?></a>
								</li>
                            <? } ?>
						</ul>
					</div>
				</div>
            <? } ?>
            <? if (!empty($arResult['EMAIL'])) { ?>
				<a href="mailto:<?= $arResult['EMAIL']; ?>" class="footer-email">
					<span class="ico-mail"></span>
                    <?= GetMessage('TQ_FOOTER_CONTACTS_WRITE_TO_US'); ?>
				</a>
            <? } ?>
            <? if (!empty($arResult['PHONE'])) { ?>
				<a href="tel:<?= $arResult['PHONE']['PHONE']; ?>" class="footer_phone-number">
					<span class="ico-phone"></span>
                    <?= $arResult['PHONE']['FORMATED']; ?>
				</a>
            <? } ?>
			<a href="#callback" data-toggle="modal"
			   class="footer-callback"><?= GetMessage('TQ_FOOTER_CONTACTS_ORDER_CALL'); ?></a>
			<div class="copyright tablet-small_hidden"><?= GetMessage('TQ_FOOTER_CONTACTS_COPYRIGHTS'); ?></div>
		</div>
		<div class="col-xl-9 col-lg-8 col-md-8 footer_right-column">
			<div class="footer-nav">
				<div class="row">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "footer",
                        Array(
                            "TITLE" => GetMessage('TQ_FOOTER_CONTACTS_MENU_CATALOG'),
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "catalog",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(0 => "",),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "catalog",
                            "USE_EXT" => "N"
                        )
                    ); ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "footer",
                        Array(
                            "TITLE" => GetMessage('TQ_FOOTER_CONTACTS_MENU_SOLUTIONS'),
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "solutions",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(0 => "",),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "solutions",
                            "USE_EXT" => "N"
                        )
                    ); ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "footer",
                        Array(
                            "TITLE" => GetMessage('TQ_FOOTER_CONTACTS_MENU_COMPANY'),
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "company",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(0 => "",),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "company",
                            "USE_EXT" => "N"
                        )
                    ); ?>
				</div>
			</div>
			<div class="main-footer_bottom">
				<ul class="social-network">
                    <? if (!empty($arResult['INST'])) { ?>
						<li><a href="<?= $arResult['INST']; ?>"><span class="ico-inst"></span></a></li>
                    <? } ?>
                    <? if (!empty($arResult['VK'])) { ?>
						<li><a href="<?= $arResult['VK']; ?>"><span class="ico-vk"></span></a></li>
                    <? } ?>
                    <? if (!empty($arResult['YOUTUBE'])) { ?>
						<li><a href="<?= $arResult['YOUTUBE']; ?>"><span class="ico-yt"><span class="path1"></span><span
											class="path2"></span><span
											class="path3"></span><span class="path4"></span><span
											class="path5"></span><span class="path6"></span><span
											class="path7"></span></span></a>
						</li>
                    <? } ?>
                    <? if (!empty($arResult['FACEBOOK'])) { ?>
						<li><a href="<?= $arResult['FACEBOOK']; ?>"><span class="ico-fb"></span></a></li>
                    <? } ?>
				</ul>
				<div class="copyright tablet-small_visible"><?= GetMessage('TQ_FOOTER_CONTACTS_COPYRIGHTS'); ?></div>
                <? if (!empty($arResult['STUDIO_LINK'])) { ?>
					<div class="footer-studio">
						<a href="<?= $arResult['STUDIO_LINK']; ?>"><img
									src="<?= SITE_TEMPLATE_PATH ?>/img/static/studio.svg" alt="alt"></a>
					</div>
                <? } ?>
			</div>
		</div>
	</div>
</div>
