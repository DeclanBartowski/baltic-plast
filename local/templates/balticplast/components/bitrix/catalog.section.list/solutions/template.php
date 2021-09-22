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
$this->setFrameMode(true); ?>

<? if (!empty($arResult["SECTIONS"])) { ?>
	<div class="catalog-mod_section">
		<div class="container">
			<div class="row">
                <? foreach ($arResult["SECTIONS"] as $arSection) {
                    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK']);
                    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK']);
                    ?>
					<div class="col-lg-3 col-md-6 col-sm-6" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
						<div class="catalog-item">
							<div class="catalog-item-img">
								<a href="<?= $arSection['SECTION_PAGE_URL']; ?>">
									<img data-src="<?= $arSection['PICTURE']['SRC']; ?>" alt="alt">
								</a>
							</div>
							<div class="catalog-item-title">
								<a href="<?= $arSection['SECTION_PAGE_URL']; ?>">
                                    <?= $arSection['NAME']; ?>
								</a>
							</div>
						</div>
					</div>
                <? } ?>
			</div>
		</div>
	</div>
<? } ?>
