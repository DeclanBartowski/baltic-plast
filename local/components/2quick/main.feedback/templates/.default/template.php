<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="popup-title"><?= GetMessage('MFT_CALLBACK_TITLE'); ?></div>
<? if (!empty($arResult["ERROR_MESSAGE"])) {
    foreach ($arResult["ERROR_MESSAGE"] as $v) {
        ShowError($v);
    }
}
if (strlen($arResult["OK_MESSAGE"]) > 0) {
    ?>
	<div class="mf-ok-text"><?= $arResult["OK_MESSAGE"] ?></div><?
}
?>
<form action="<?= POST_FORM_ACTION_URI ?>" method="POST" class="callback-form">
    <?= bitrix_sessid_post() ?>
	<div class="form-group">
		<input type="text" name="NAME" class="form-control requiredField callback-name">
		<label class="form-label"><?= GetMessage('MFT_NAME'); ?>*</label>
	</div>
	<div class="form-group">
		<label class="form-label"><?= GetMessage('MFT_PHONE'); ?>*</label>
		<input type="tel" name="PHONE" class="form-control requiredField callback-phone">
	</div>
	<input type="submit" name="submit" class="callback-form_submit main-btn js_form-submit"
	       value="<?= GetMessage('MFT_SUBMIT_BUTTON'); ?>">
	<div class="form-policy">
        <?= GetMessage('MFT_POLICY_TEXT'); ?>
	</div>
	<input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
</form>
