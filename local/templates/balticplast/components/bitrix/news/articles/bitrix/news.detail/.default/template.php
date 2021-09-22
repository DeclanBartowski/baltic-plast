<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<? if (!empty($arResult['SLIDER'])) { ?>
	<div class="article-detailed_slider">
        <? foreach ($arResult['SLIDER'] as $arImage) { ?>
			<div class="slide-wrap">
				<div class="article-detailed_item" style="background-image:url(<?= $arImage['SRC']; ?>)">
					<div class="container">
						<h1 class="main-title"><?= $arResult['NAME']; ?></h1>
					</div>
				</div>
			</div>
        <? } ?>
	</div>
<? } ?>
<div class="container">
	<div class="article-detailed_body">
        <?= $arResult['DETAIL_TEXT']; ?>
	</div>
	<div class="article-detailed_footer">
		<a href="<?= $arParams['IBLOCK_URL']; ?>" class="back-articles_btn">
			<span class="ico-arrow"></span>
            <?= GetMessage('TQ_ARTICLES_DETAIL_ALL_ARTICLES'); ?>
		</a>
		<div class="right-column">
			<div class="text"><?= GetMessage('TQ_ARTICLES_DETAIL_SHARE'); ?></div>
			<!-- AddToAny BEGIN -->
			<ul class="a2a_kit a2a_kit_size_32 a2a_default_style social-network_mod-2">
				<li>
					<a class="a2a_button_vk">
						<img alt="alt" src="<?= SITE_TEMPLATE_PATH ?>/img/icons/social-2/vk.svg">
					</a>
				</li>
				<li>
					<a class="a2a_button_facebook">
						<img alt="alt" src="<?= SITE_TEMPLATE_PATH ?>/img/icons/social-2/fb.svg">
					</a>
				</li>
				<li>
					<a class="a2a_button_odnoklassniki">
						<img alt="alt" src="<?= SITE_TEMPLATE_PATH ?>/img/icons/social-2/odn.svg">
					</a>
				</li>


				<li>
					<a class="a2a_button_twitter">
						<img alt="alt" src="<?= SITE_TEMPLATE_PATH ?>/img/icons/social-2/twitter.svg">
					</a>
				</li>
				<li>
					<a class="a2a_button_viber">
						<img alt="alt" src="<?= SITE_TEMPLATE_PATH ?>/img/icons/social-2/viber.svg">
					</a>
				</li>
				<li>
					<a class="a2a_button_whatsapp">
						<img alt="alt" src="<?= SITE_TEMPLATE_PATH ?>/img/icons/social-2/whatsapp.svg">
					</a>
				</li>
				<li>
					<a class="a2a_button_telegram">
						<img alt="alt" src="<?= SITE_TEMPLATE_PATH ?>/img/icons/social-2/telegram.svg">
					</a>
				</li>
			</ul>
			<script async src="https://static.addtoany.com/menu/page.js"></script>
			<!-- AddToAny END -->
		</div>
	</div>
</div>
