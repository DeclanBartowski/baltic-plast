<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 */

$this->setFrameMode(true); ?>
<? if (!empty($arResult['ITEMS'])) { ?>
	<div class="viewed-products_section">
		<div class="container">
			<div class="viewed-products_header">
				<div class="section-title"><?= GetMessage('TQ_VIEWED_TITLE'); ?></div>
				<div class="viewed-products_counter">
					<span class="pagination-number"></span>
					<span class="divider">/ <?= GetMessage('TQ_VIEWED_FROM'); ?></span>
					<span class="pagination-digit"></span>
				</div>
			</div>
			<div class="viewed-products_slider">
                <?
                foreach ($arResult['ITEMS'] as $arItem) {
                    $uniqueId = $arItem['ID'] . '_' . md5($this->randString() . $component->getAction());
                    $areaIds[$arItem['ID']] = $this->GetEditAreaId($uniqueId);
                    $this->AddEditAction($uniqueId, $arItem['EDIT_LINK']);
                    $this->AddDeleteAction($uniqueId, $arItem['DELETE_LINK']);
                    ?>
					<div class="viewed-product_item" id="<?= $areaIds[$arItem['ID']]; ?>">
						<a href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
							<div class="viewed-product_item-img">
								<img data-src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="<?= $arItem['NAME']; ?>">
							</div>
							<div class="viewed-product_item-desc">
								<span class="viewed-product_item-title"><?= $arItem['NAME']; ?></span>
								<span class="viewed-product_item-price"><?= $arItem['TQ_PRICE']['PRINT_PRICE']; ?> <?= $arItem['ITEM_MEASURE']['TITLE']; ?></span>
							</div>
						</a>
					</div>
                    <?
                }
                ?>
			</div>
		</div>
	</div>
<? } ?>
