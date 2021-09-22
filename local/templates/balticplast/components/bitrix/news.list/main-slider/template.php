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
	<div class="main-section">
		<div class="main-slider">
            <? foreach ($arResult["ITEMS"] as $arItem) {
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
				<div class="slide-wrap" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<div class="main-slide" style="background-image:url(<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>)">
						<div class="container">
							<h1 class="main-slide_title"><?= $arItem['NAME']; ?> <span
										class="min"><?= $arItem['PREVIEW_TEXT']; ?></span></h1>
						</div>
					</div>
				</div>
            <? } ?>
		</div>
	</div>
	<!-- end main-section -->
<? } ?>
