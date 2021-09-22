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

<ul class="category-list">
    <? foreach ($arResult['SECTIONS'] as $arSection) { ?>
		<li<? if ($arSection['ID'] == $arParams['CURRENT_SECTION']) { ?> class="active"<? } ?>>
			<div class="category-mod_item">
				<a href="<?= $arSection['SECTION_PAGE_URL']; ?>">
						<span class="category-mod_item-img">
							<img data-src="<?= $arSection['PICTURE']['SRC']; ?>"
							     alt="<?= $arSection['NAME']; ?>">
						</span>
					<span class="text"><?= $arSection['NAME']; ?></span>
				</a>
			</div>
		</li>
    <? } ?>
</ul>
