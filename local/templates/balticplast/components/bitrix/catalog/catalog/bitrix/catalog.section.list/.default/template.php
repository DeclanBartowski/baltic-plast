<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
$flag = true;
?>
<? if (!empty($arResult['ROOT']['CHILD'])) { ?>
	<div class="row no-gutters">
        <? foreach ($arResult['ROOT']['CHILD'] as $arSection) { ?>
			<div class="col-md-6<? if ($flag) { ?> left-column<? $flag = false;
            } else { ?> right-column<? $flag = true;
            } ?>">
				<div class="category-item">
					<div class="category-item_img">
						<a href="<?=$arSection['SECTION_PAGE_URL'];?>"><img src="<?= $arSection['PICTURE']['SRC']; ?>" alt="alt"></a>
					</div>
					<div class="category-item_desc">
						<span class="category-item_title"><?= $arSection['NAME']; ?></span>
						<ul class="category-item_menu">
                            <? foreach ($arSection['CHILD'] as $arSubSection) { ?>
								<li>
									<a href="<?= $arSubSection['SECTION_PAGE_URL']; ?>"><?= $arSubSection['NAME']; ?></a>
								</li>
                            <? } ?>
						</ul>
						<a href="<?= $arSection['SECTION_PAGE_URL']; ?>" class="category-item_link">
							<span class="text"><?= GetMessage('TQ_CATALOG_SECTIONS_VIEW'); ?></span>
							<span class="ico-arrow"></span>
						</a>
					</div>
				</div>
			</div>
        <? } ?>
	</div>
<? } ?>
