<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
?>

<div class="product-item">
	<div class="product-item_img">
		<a href="<?= $item['DETAIL_PAGE_URL']; ?>" title="<?= $imgTitle; ?>">
			<img data-src="<?= $item['PREVIEW_PICTURE']['SRC']; ?>" alt="<?= $imgTitle; ?>">
		</a>
	</div>
	<div class="product-item_desc">
		<div class="product-item_title">
			<a href="<?= $item['DETAIL_PAGE_URL']; ?>"><?= $item['NAME'] ?></a>
		</div>
		<p><?= $item['PREVIEW_TEXT']; ?></p>
		<span class="product-item_price"><?= $item['MIN_PRICE']['PRINT_DISCOUNT_VALUE_VAT']; ?></span>
	</div>
    <? if ($item['MIN_PRICE']['CAN_BUY']) { ?>
		<a href="javascript:void(0)"
		   data-action="add2basket"
		   data-to-basket="<?= GetMessage('TQ_JS_MOVE_TO_BASKET'); ?>"
		   data-added="<?= GetMessage('TQ_JS_ADDED_TO_BASKET'); ?>"
		   data-id="<?= $item['ID']; ?>"
		   class="main-btn product-item_btn">
			<span class="ico-check"></span>
			<span class="ico-basket"></span>
			<span class="text"><?= GetMessage('TQ_CATALOG_ITEM_ADD_TO_BASKET'); ?></span>
		</a>
    <? } ?>
</div>


