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
<div class="popup-title"><?= GetMessage('TQ_AUTH_TEMPLATE_AUTH_TITLE'); ?></div>
<form method="POST" id="login-form" class="log-register_form login-form">
	<div class="tq-component-error">
        <? if (!empty($arResult['ERRORS'])) { ?>
            <?= $arResult['ERRORS'] ?>
        <? } ?>
	</div>
	<div class="form-group">
		<input type="email" name="email" class="form-control">
		<label class="form-label"><?= GetMessage('TQ_AUTH_TEMPLATE_AUTH_EMAIL'); ?></label>
	</div>
	<div class="form-group">
		<label class="form-label"><?= GetMessage('TQ_AUTH_TEMPLATE_AUTH_PASSWORD'); ?></label>
		<input type="password" name="password" class="form-control">
	</div>
	<div class="login-form_flex-row">
		<label class="unified-checkbox">
			<input value="Y" type="checkbox" name="remember">
			<span class="checkbox-text">
				<?= GetMessage('TQ_AUTH_TEMPLATE_AUTH_REMEMBER_ME'); ?>
			</span>
		</label>
		<a href="javascript:void(0)"
		   class="forgot-password_btn"><?= GetMessage('TQ_AUTH_TEMPLATE_AUTH_RESTORE_PASSWORD'); ?></a>
	</div>
	<input name="submit" type="submit" class="login-form_submit main-btn"
	       value="<?= GetMessage('TQ_AUTH_TEMPLATE_AUTH_LOGIN'); ?>">
	<a href="javascript:void(0)"
	   class="gray-btn js_register-btn"><?= GetMessage('TQ_AUTH_TEMPLATE_AUTH_REGISTER'); ?>
	</a>
</form>
