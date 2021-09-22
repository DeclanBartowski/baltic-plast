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
	<div class="row align-items-center">
		<div class="col-xl-5 col-lg-6 left-column">
            <?= $arResult['DESCRIPTION']; ?>
		</div>
		<div class="col-xl-7 col-lg-6">
			<ul class="advantages-box_digit">
                <? foreach ($arResult["ITEMS"] as $arItem) {
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                        array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
					<li class="advantage-item_mod is-fade" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<span class="advantage-item_number">
									<span class="advantage-item_digit"><?= $arItem['PROPERTIES']['NUMBER']['VALUE']; ?></span><?= $arItem['PROPERTIES']['NUMBER']['DESCRIPTION']; ?></span>
						<span class="text"><?= $arItem['PREVIEW_TEXT']; ?></span>
					</li>
                <? } ?>
			</ul>
		</div>
	</div>
<? } ?>
