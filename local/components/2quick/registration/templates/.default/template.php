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

<div class="popup-title"><?= GetMessage('TQ_REGISTRATION_FORM_TITLE'); ?></div>
<form class="log-register_form tq-register-form" id="modal-reg-form">
	<div class="tq-component-error">
        <? if (!empty($arResult['ERRORS'])) { ?>
            <?= $arResult['ERRORS'] ?>
        <? } ?>
	</div>
	<div class="form-group">
		<input type="email" name="email" class="form-control">
		<label class="form-label"><?= GetMessage('TQ_REGISTRATION_FORM_EMAIL'); ?></label>
	</div>
	<ul class="log-register_form-list">
		<li>
			<label class="unified-checkbox">
				<input value="1" type="checkbox" name="UF_MARKETING">
				<span class="checkbox-text">
					<?= GetMessage('TQ_REGISTRATION_FORM_MARKETING'); ?>
				</span>
			</label>
		</li>
		<li>
			<label class="unified-checkbox">
				<input value="" type="checkbox" name="checkbox">
				<span class="checkbox-text">
					<?= GetMessage('TQ_REGISTRATION_FORM_PRIVACY_POLICY'); ?>
				</span>
			</label>
		</li>
	</ul>
	<input type="submit" name="submit" class="login-form_submit main-btn"
	       value="<?= GetMessage('TQ_REGISTRATION_FORM_REGISTER_BUTTON'); ?>">
	<a href="" class="gray-btn js_login-btn"><?= GetMessage('TQ_REGISTRATION_FORM_LOGIN'); ?> </a>
</form>
