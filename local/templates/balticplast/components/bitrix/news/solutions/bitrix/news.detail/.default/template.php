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
CJSCore::Init(array('currency'));
?>

<div class="row product-card_content">
	<div class="col-lg-6 product-card_left-column">
		<div class="tablet-visible">
			<h1 class="product-card_title"><?= $arResult['NAME']; ?></h1>
		</div>
        <? if (!empty($arResult['SLIDER'])) { ?>
			<div class="wrapper_product-card_slider js-fixed-slider">
				<div class="product-card_slider">
                    <? foreach ($arResult['SLIDER'] as $arSlide) { ?>
						<div class="product-card_item">
							<a href="<?= $arSlide['FULL']; ?>" class="fancybox" data-fancybox="group">
								<img data-src="<?= $arSlide['SRC']; ?>" alt="<?= $arResult['NAME']; ?>">
							</a>
						</div>
                    <? } ?>
				</div>
				<ul class="product-card_small-slider">
                    <? foreach ($arResult['SLIDER'] as $arSlide) { ?>
						<li class="product-card_small-item">
							<img data-src="<?= $arSlide['SMALL']; ?>" alt="<?= $arResult['NAME']; ?>">
						</li>
                    <? } ?>
				</ul>
			</div>
        <? } ?>
	</div>
	<div class="col-lg-6 product-card_desc">
		<div class="tablet-hidden">
			<h1 class="product-card_title"><?= $arResult['NAME']; ?></h1>
		</div>
		<div class="equipment-content">
            <? foreach ($arResult['PRODUCTS'] as $arItem) {
                $currencyFormat = CCurrencyLang::GetFormatDescription($arItem['PRICE']['PRICE']['CURRENCY']); ?>
				<script>
                    BX.Currency.setCurrencyFormat("<?=$arItem['PRICE']['PRICE']['CURRENCY'];?>", <? echo CUtil::PhpToJSObject($currencyFormat,
                        false, true); ?>);
				</script>
				<div class="equipment-item">
					<div class="checkbox-cell">
						<label class="unified-checkbox">
							<input value="<?= $arItem['ID']; ?>"
							       class="item-checkbox"
							       type="checkbox"
							       data-add-error="<?= GetMessage("TQ_JS_ADDED_TO_BASKET_ERROR",
                                       [
                                           "#MIN#" => $arItem['PROPERTY_MINIMUM_VALUE'] . ' ' . $arItem['MEASURE']['SYMBOL']
                                       ]
                                   ); ?>"
							       data-currency="<?= $arItem['PRICE']['PRICE']['CURRENCY']; ?>"
							       data-price="<?= $arItem['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE']; ?>"
							       data-discount="<?= $arItem['PRICE']['RESULT_PRICE']['DISCOUNT']; ?>"
							       data-measure="<?= $arItem['MEASURE']['SYMBOL']; ?>"
							       name="products">
							<span class="checkbox-text"></span>
						</label>
					</div>
					<div class="equipment-item_product">
						<a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="equipment-item_img"><img data-src="<?= $arItem['PREVIEW_PICTURE']; ?>"
						                                     alt="<?= $arItem['NAME']; ?>"></a>
						<div class="equipment-item_desc">
							<a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="equipment-item_title"><?= $arItem['NAME']; ?></a>
                            <? if (!empty($arItem['PROPERTY_ARTNUMBER_VALUE'])) { ?>
								<span class="equipment-item_code"><?= GetMessage('TQ_SOLUTION_ARTNUMBER'); ?>: <?= $arItem['PROPERTY_ARTNUMBER_VALUE']; ?></span>
                            <? } ?>
							<span class="equipment-item_price"><?= $arItem['PRICE']['FORMATED_PRICE']; ?> <?= $arItem['MEASURE']['SYMBOL']; ?></span>
						</div>
					</div>
					<div class="equipment-item_right-column">
						<div class="wrapper-counter-btn">
							<button class="counter-back"></button>
							<input type="text" value="1 <?= GetMessage('TQ_SOLUTION_QUANTITY'); ?>"
							       name="quantity[<?= $arItem['ID']; ?>]"
							       data-langth="<?= $arItem['LENGTH']['NUM'];?>"
							       data-measure="<?= $arItem['LENGTH']['MEASURE'];?>"
							       data-msg="<?= GetMessage('TQ_SOLUTION_QUANTITY'); ?>"
							       class="product-count">
							<button class="counter-forward"></button>
						</div>
						<div class="equipment-item_size">
							<div class="left-column">
								<div class="equipment-item_attention">
									<span class="attention-icon">!</span>
									<span class="attention-prompt"><?= GetMessage('TQ_SOLUTION_MINIMUM'); ?> <?= $arItem['PROPERTY_MINIMUM_VALUE']; ?>
                                        <?= $arItem['MEASURE']['SYMBOL']; ?> </span>
								</div>
							</div>
							<div class="right-column">
								<span class="text"><?= GetMessage('TQ_SOLUTION_LENGTH'); ?>:</span>
								<span class="equipment-item_size-digit"><?= $arItem['PROPERTY_LENGTH_VALUE']; ?></span>
								<span class="equipment-item_size-delete ico-close"></span>
							</div>
						</div>
					</div>
				</div>
            <? } ?>
		</div>

		<div class="equipment-footer">
			<div class="left-column">
				<table class="equipment_total-table">
					<tr>
						<td><?= GetMessage('TQ_SOLUTION_PRICE_DISCOUNT'); ?>:</td>
						<td class="tq-discount-result"></td>
					</tr>
                    <? /*
					<tr>
						<td>Доставка:</td>
						<td>0 руб. п/м.</td>
					</tr>
					*/ ?>
				</table>
			</div>
			<div class="right-column">
				<span class="text"><?= GetMessage('TQ_SOLUTION_PRICE_SUM'); ?>:</span>
				<span class="equipment_total-sum"></span>
			</div>
		</div>
		<a href="javascript:void(0)"
		   style="display: none"
		   data-action="addSolution"
		   data-basket-link="<?= SITE_DIR ?>basket/"
		   data-to-basket="<?= GetMessage('TQ_SOLUTION_TO_BASKET_TEXT'); ?>"
		   data-added="<?= GetMessage('TQ_JS_ADDED_TO_BASKET'); ?>"
		   class="main-btn product-card_btn product-card_btn-mod">
			<span class="ico-check"></span>
			<span class="ico-basket"></span>
			<span class="text"><?= GetMessage('TQ_SOLUTION_ADD_TO_BASKET'); ?></span>
		</a>
		<a href="javascript:void(0)"
		   style="display: none"
		   data-action="addSolution"
		   data-basket-link="<?= SITE_DIR ?>basket/"
		   data-to-basket-text="<?= GetMessage('TQ_SOLUTION_TO_BASKET_TEXT'); ?>"
		   class="main-btn product-card_btn product-card_btn-mod product-card_btn-fixed">
			<span class="ico-check"></span>
			<span class="ico-basket"></span>
			<span class="text"><?= GetMessage('TQ_SOLUTION_ADD_TO_BASKET'); ?></span>
		</a>
	</div>
</div>
