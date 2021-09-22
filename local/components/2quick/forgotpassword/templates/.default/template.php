<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Page\Asset;

/** @var array $arParams */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var array $arResult */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

?>
<div class="popup-title"><?= GetMessage('TQ_FRG_PSWRD_TITLE'); ?></div>
<form method="POST" id="forgot-password-form" class="access-form forgot-password-form">
	<div class="tq-component-error">
        <? if (!empty($arResult['ERRORS'])) { ?>
            <?= $arResult['ERRORS'] ?>
        <? } ?>
	</div>
	<div class="form-group">
		<input type="email" name="email" required class="form-control">
		<label class="form-label"><?= GetMessage('TQ_FRG_PSWRD_EMAIL'); ?></label>
	</div>
	<input type="submit" class="access-form_submit main-btn" value="<?= GetMessage('TQ_FRG_PSWRD_NEW_PSWRD'); ?>">
	<a href="javascript:void(0)" class="gray-btn js_register-btn"><?= GetMessage('TQ_FRG_PSWRD_REGISTER'); ?></a>
	<a href="javascript:void(0)" class="gray-btn js_login-btn"><?= GetMessage('TQ_FRG_PSWRD_LOGIN'); ?></a>
</form>