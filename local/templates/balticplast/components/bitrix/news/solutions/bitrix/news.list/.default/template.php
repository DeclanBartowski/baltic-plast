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
$bxajaxid = CAjax::GetComponentID($component->__name, $component->__template->__name,
    $component->arParams['AJAX_OPTION_ADDITIONAL']);
?>
<? if (!empty($arResult["ITEMS"])) { ?>
	<div class="row solutions-row">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
			<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<div class="solution-item">
                    <? if (!empty($arItem['SLIDER'])) { ?>
						<div class="solution-item_img">
                            <? foreach ($arItem['SLIDER'] as $item) { ?>
								<img data-src="<?= $item; ?>" alt="<?= $arItem['NAME']; ?>">
                            <? } ?>
						</div>
                    <? } ?>
					<div class="solution-item_title">
						<a href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
                            <?= $arItem['NAME']; ?>
						</a>
					</div>
					<p><?= $arItem['PREVIEW_TEXT']; ?></p>
				</div>
			</div>
        <? endforeach; ?>
	</div>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
		<div class="wrapper-pagination"<? /* id="btn_<?= $bxajaxid ?>"*/ ?>>
            <?= $arResult["NAV_STRING"] ?>
            <? /* if ($arResult["NAV_RESULT"]->nEndPage > 1 && $arResult["NAV_RESULT"]->NavPageNomer < $arResult["NAV_RESULT"]->nEndPage): ?>
			<a data-ajax-id="<?= $bxajaxid ?>" href="javascript:void(0)"
			   data-show-more="<?= $arResult["NAV_RESULT"]->NavNum ?>"
			   data-next-page="<?= ($arResult["NAV_RESULT"]->NavPageNomer + 1) ?>"
			   data-max-page="<?= $arResult["NAV_RESULT"]->nEndPage ?>"
			   class="loading-goods_btn">
				<span class="ico-load"></span>
                <?= GetMessage('TQ_ARTICLES_LIST_SHOW_MORE_BUTTON'); ?>
			</a>
        <? endif */ ?>
		</div>
    <? endif; ?>
<? } ?>