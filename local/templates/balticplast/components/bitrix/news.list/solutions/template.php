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
	<div class="solutions-section">
		<div class="container">
			<h2><?= GetMessage('TQ_SOLUTIONS_TITLE'); ?></h2>
			<div class="row solutions-row">
                <? foreach ($arResult["ITEMS"] as $arItem) {
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                        array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
					<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<div class="solution-item">
							<div class="solution-item_img">
                                <? foreach ($arItem['SLIDER'] as $arSlide) { ?>
									<img data-src="<?= $arSlide['SRC']; ?>" alt="<?= $arItem['NAME']; ?>">
                                <? } ?>
							</div>
							<div class="solution-item_title">
								<a href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
                                    <?= $arItem['NAME']; ?>
								</a>
							</div>
							<p><?= $arItem['PREVIEW_TEXT']; ?></p>
						</div>
					</div>
                <? } ?>
			</div>
		</div>
	</div>
	<!-- end solutions-section -->
<? } ?>
