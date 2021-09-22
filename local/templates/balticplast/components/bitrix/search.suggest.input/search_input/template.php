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

<form action="<?= SITE_DIR ?>search/" class="form-search">
	<input type="text" class="form-search_input"
        <? if ($arParams["INPUT_SIZE"] > 0): ?>
			size="<? echo $arParams["INPUT_SIZE"] ?>"
        <? endif ?>
		   name="<? echo $arParams["NAME"] ?>"
		   id="<? echo $arResult["ID"] ?>"
		   value="<? echo $arParams["VALUE"] ?>"
		   autocomplete="off"
		   placeholder="<?= GetMessage('TQ_SEARCH_FORM_INPUT_PLACEHOLDER'); ?>">
	<div class="wrapper_form-search_submit">
		<span class="ico-search"></span>
		<input type="submit" class="form-search_submit" value="">
	</div>
	<span class="form-search_delete-btn ico-close"></span>
</form>