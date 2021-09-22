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
<? if (!empty($arResult["ITEMS"])) { ?>
	<div class="article-section">
		<div class="container">
			<div class="article-section-header">
				<div class="section-title"><?= GetMessage('TQ_HELPFUL_INFORMATION_TITLE'); ?></div>
				<a href="<?= SITE_DIR ?>helpful-information/" class="main-btn_mod tablet-small_hidden">
                    <?= GetMessage('TQ_HELPFUL_INFORMATION_WATCH_ALL'); ?> <span class="ico-arrow"></span>
				</a>
			</div>
			<div class="row product-mod_row">
                <? foreach ($arResult["ITEMS"] as $arItem) {
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                        array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
					<div class="col-lg-3 col-md-6 col-sm-6" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<div class="article-item">
							<div class="article-item-img">
								<a href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
									<span class="article-item-name"><?= $arItem['PROPERTIES']['LABEL']['VALUE']; ?></span>
									<img data-src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>"
									     alt="<?= $arItem['NAME']; ?>">
								</a>
							</div>
							<div class="article-item-title">
								<a href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
                                    <?= $arItem['NAME']; ?>
								</a>
							</div>
						</div>
					</div>
                <? } ?>
			</div>
			<div class="text-center tablet-small_visible">
				<a href="<?= SITE_DIR ?>helpful-information/" class="main-btn_mod unified_mobile-btn">
                    <?= GetMessage('TQ_HELPFUL_INFORMATION_WATCH_ALL'); ?> <span class="ico-arrow"></span>
				</a>
			</div>
		</div>
	</div>
<? } ?>
