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
	<div class="work-process_box">
		<div class="section-title work-process_title"><?= GetMessage('TQ_WORK_PROCESS_TITLE'); ?></div>
		<div class="work-process_slider">
            <? foreach ($arResult["ITEMS"] as $arItem) {
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
				<div class="work-process_slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<a href="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" class="fancybox"
					   data-caption="<?= $arItem['NAME']; ?>"
					   data-fancybox="group">
						<span class="loop-icon ico-arrows"></span>
						<img data-src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="<?= $arItem['NAME']; ?>">
						<span class="work-process_slide-title"><?= $arItem['NAME']; ?></span>
					</a>
				</div>
            <? } ?>
		</div>
	</div>
<? } ?>
