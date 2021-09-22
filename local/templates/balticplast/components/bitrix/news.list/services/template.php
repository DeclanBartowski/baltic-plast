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
    <? foreach ($arResult["ITEMS"] as $key =>$arItem) {
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
            array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
		<div class="services-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<div class="row no-gutters align-items-center">
				<div class="col-lg-6<?if($key%2 != 0){?> order-lg-2<?}?>">
					<div class="services-item_img">
						<img data-src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="<?= $arItem['NAME']; ?>">
					</div>
				</div>
				<div class="col-lg-6<?if($key%2 == 0){?> left-column<?}?>">
					<div class="services-item_desc">
                        <?= $arItem['PREVIEW_TEXT']; ?>
					</div>
				</div>
			</div>
		</div>
    <? } ?>
<? } ?>
