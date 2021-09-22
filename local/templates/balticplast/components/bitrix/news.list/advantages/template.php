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
	<div class="advantages-box<? if (!empty($arParams['ADDITIONAL_CLASS'])) { ?> <?= $arParams['ADDITIONAL_CLASS']; ?><? } ?>">
		<div class="container">
			<div class="row">
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                        array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
					<div class="col-md-4" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<div class="advantage-item">
						<span class="advantage-item_icon">
							<img data-src="<?= CFile::GetPath($arItem['PROPERTIES']['ICON']['VALUE']); ?>"
							     alt="<?= $arItem['NAME']; ?>">
						</span>
							<div class="advantage-item_desc">
								<span class="advantage-item_title"><?= $arItem['NAME']; ?></span>
								<p>
                                    <?= $arItem['PREVIEW_TEXT']; ?>
								</p>
							</div>
						</div>
					</div>
                <? endforeach; ?>
			</div>
		</div>
	</div>
	<!-- end advantages-box -->
<? } ?>
