<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>
<form action="" method="get" class="main_form-search">
	<input type="text"
	       class="main_form-search_input"
	       placeholder="<?= GetMessage('TQ_SEARCH_PAGE_INPUT_PLACEHOLDER'); ?>"
	       name="q"
	       value="<?= $arResult["REQUEST"]["QUERY"] ?>"
	       size="40"
	/>
	<div class="wrapper-submit">
		<span class="ico-search"></span>
		<input type="submit" class="main_form-search_submit" value="">
	</div>
	<span class="form-search_delete-btn ico-close"></span>
</form>
