<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true); ?>

<div class="row product-card_content">
	<div class="col-lg-6">
		<div class="tablet-visible">
			<h1 class="product-card_title"><?= $arResult['NAME']; ?></h1>
            <? if (!empty($arResult['PROPERTIES']['ARTNUMBER']['VALUE'])) { ?>
				<span class="product-card_code">
				<?= GetMessage('TQ_PRODUCT_ARTNUMBER'); ?>: <?= $arResult['PROPERTIES']['ARTNUMBER']['VALUE']; ?>
			</span>
            <? } ?>
		</div>
        <? if (!empty($arResult['SLIDER'])) { ?>
			<div class="wrapper_product-card_slider">
				<div class="product-card_slider">
                    <? foreach ($arResult['SLIDER'] as $arSlider) { ?>
						<div class="product-card_item">
							<a href="<?= $arSlider['FULL']; ?>" class="fancybox" data-fancybox="group">
								<img data-src="<?= $arSlider['SRC']; ?>" alt="<?= $arResult['NAME']; ?>">
							</a>
						</div>
                    <? } ?>
				</div>
				<ul class="product-card_small-slider">
                    <? foreach ($arResult['SLIDER'] as $arSlider) { ?>
						<li class="product-card_small-item">
							<img data-src="<?= $arSlider['SMALL']; ?>" alt="<?= $arResult['NAME']; ?>">
						</li>
                    <? } ?>
				</ul>
			</div>
        <? } ?>
	</div>
	<div class="col-lg-6 product-card_desc">
		<div class="tablet-hidden">
			<h1 class="product-card_title"><?= $arResult['NAME']; ?></h1>
            <? if (!empty($arResult['PROPERTIES']['ARTNUMBER']['VALUE'])) { ?>
				<span class="product-card_code"><?= GetMessage('TQ_PRODUCT_ARTNUMBER'); ?>: <?= $arResult['PROPERTIES']['ARTNUMBER']['VALUE']; ?></span>
            <? } ?>
		</div>

		<div class="wrapper_product-card_price">
			<div class="product-card_price"><?= $arResult["PRICE_REFORMATED"]; ?></div>
            <? if (!empty($arResult['PROPERTIES']['MINIMUM']['VALUE'])) { ?>
				<div class="product-card_attention">
					<span class="icon">!</span><?= GetMessage('TQ_PRODUCT_PRICE_MIN'); ?>
                    <?= $arResult['PROPERTIES']['MINIMUM']['VALUE']; ?>
                    <?= $arResult['ITEM_MEASURE']['TITLE']; ?>
				</div>
            <? } ?>
		</div>
        <? if (($arResult['CAN_BUY'] == 'Y' && $arResult['CATALOG_QUANTITY'] > 0) ||
            !empty($arResult['PROPERTIES']['LENGTH']['VALUE'])) { ?>
			<div class="product-card_top-panel">
                <? if ($arResult['CAN_BUY'] == 'Y') { ?>
					<div class="wrapper-counter-btn wrapper-counter_product-btn">
						<button class="counter-back"></button>
						<input type="text"
						       data-langth="<?= $arResult['LENGTH']['NUM']; ?>"
						       data-measure="<?= $arResult['LENGTH']['MEASURE']; ?>"
						       data-msg="<?= GetMessage('TQ_PRODUCT_QUANTITY'); ?>"
						       value="1 <?= GetMessage('TQ_PRODUCT_QUANTITY'); ?>"
						       class="product-count">
						<button class="counter-forward"></button>
					</div>
                <? } ?>
                <? if (!empty($arResult['PROPERTIES']['LENGTH']['VALUE'])) { ?>
					<div class="product-card_size">
						<span class="text"><?= GetMessage('TQ_PRODUCT_LENGTH'); ?>:</span>
						<span class="product-card_size-digit"><?= $arResult['PROPERTIES']['LENGTH']['VALUE']; ?></span>
						<span class="product-card_size-delete ico-close"></span>
					</div>
                <? } ?>
			</div>
        <? } ?>
		<a href="javascript:void(0)" class="main-btn product-card_btn"
		   data-to-basket="<?= GetMessage('TQ_JS_MOVE_TO_BASKET'); ?>"
		   data-added="<?= GetMessage('TQ_JS_ADDED_TO_BASKET'); ?>"
		   data-add-error="<?= GetMessage("TQ_JS_ADDED_TO_BASKET_ERROR",
               [
                   "#MIN#" => $arResult['PROPERTIES']['MINIMUM']['VALUE'] . ' ' . $arResult['ITEM_MEASURE']['TITLE']
               ]
           ); ?>"
		   data-action="add2basket"
		   data-id="<?= $arResult['ID']; ?>">
			<span class="ico-check"></span>
			<span class="ico-basket"></span>
			<span class="text"><?= GetMessage('TQ_PRODUCT_ADD_TO_BASKET'); ?></span>
		</a>
        <? if (!empty($arResult['PROPERTIES']['CHARS']['VALUE'])) { ?>
			<div class="product-card_desc-item item-features">
				<span class="product-card_subtitle"><?= GetMessage('TQ_PRODUCT_CHARS'); ?></span>
				<table class="product-card_features-table">
                    <? foreach ($arResult['PROPERTIES']['CHARS']['VALUE'] as $key => $val) { ?>
						<tr>
							<td><?= $val; ?></td>
							<td><?= $arResult['PROPERTIES']['CHARS']['DESCRIPTION'][$key]; ?></td>
						</tr>
                    <? } ?>
				</table>
			</div>
        <? } ?>
        <? if (!empty($arResult['DETAIL_TEXT'])) { ?>
			<div class="product-card_desc-item">
				<span class="product-card_subtitle"><?= GetMessage('TQ_PRODUCT_PRODUCT_DESCRIPTION'); ?></span>
				<p>
                    <?= $arResult['DETAIL_TEXT']; ?>
				</p>
			</div>
        <? } ?>
        <? if ($arResult['CAN_BUY'] == 'Y' && $arResult['CATALOG_QUANTITY'] > 0) { ?>
			<a href="javascript:void(0)" class="main-btn product-card_btn product-card_btn-fixed"
			   data-action="add2basket" data-id="<?= $arResult['ID']; ?>">
				<span class="ico-check"></span>
				<span class="ico-basket"></span>
				<span class="text"><?= GetMessage('TQ_PRODUCT_ADD_TO_BASKET'); ?></span>
			</a>
        <? } ?>
	</div>
</div>