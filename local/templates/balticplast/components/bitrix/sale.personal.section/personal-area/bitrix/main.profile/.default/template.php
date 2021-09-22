<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

?>

<div class="personal-data_content">
	<div class="personal-data_header">
		<div class="h3"><?= Loc::getMessage('TQ_PERSONAL_DATA_TITLE'); ?></div>
        <? /*
		<button class="personal-data_edit-btn"><?=Loc::getMessage('TQ_PERSONAL_DATA_EDIT');?></button>
		*/ ?>
	</div>
    <?
    ShowError($arResult["strProfileError"]);

    if ($arResult['DATA_SAVED'] == 'Y') {
        ShowNote(Loc::getMessage('PROFILE_DATA_SAVED'));
    }

    ?>
	<form method="post" name="form1" action="<?= POST_FORM_ACTION_URI ?>" enctype="multipart/form-data" role="form"
	      class="personal-data_form">
        <?= $arResult["BX_SESSION_CHECK"] ?>
		<input type="hidden" name="lang" value="<?= LANG ?>"/>
		<input type="hidden" name="ID" value="<?= $arResult["ID"] ?>"/>
		<input type="hidden" name="LOGIN" value="<?= $arResult["arUser"]["LOGIN"] ?>"/>
		<div class="row">
            <? if ($arParams['CAN_EDIT_PASSWORD'] == 'Y') { ?>
				<div class="col-lg-4 col-md-6">
					<div class="form-group">
						<input type="password" class="form-control"
						       value=""
						       required
						       autocomplete="off"
						       maxlength="50"
						       name="NEW_PASSWORD"
						       id="main-profile-password"
						       placeholder="<?= Loc::getMessage('NEW_PASSWORD_REQ') ?>">
					</div>
				</div>

				<div class="col-lg-4 col-md-6">
					<div class="form-group">
						<input type="password" class="form-control"
						       value=""
						       required
						       autocomplete="off"
						       maxlength="50"
						       name="NEW_PASSWORD_CONFIRM"
						       id="main-profile-password-confirm"
						       placeholder="<?= Loc::getMessage('NEW_PASSWORD_CONFIRM') ?>">
					</div>
				</div>

            <? } else { ?>
				<div class="col-lg-4 col-md-6">
					<div class="form-group">
						<input type="text" class="form-control"
						       value="<?= $arResult["arUser"]["LAST_NAME"] ?>"
						       name="LAST_NAME"
						       placeholder="<?= Loc::getMessage('LAST_NAME') ?>">
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="form-group">
						<input type="text" class="form-control"
						       name="NAME"
						       value="<?= $arResult["arUser"]["NAME"] ?>"
						       placeholder="<?= Loc::getMessage('NAME') ?>">
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="form-group">
						<input type="text" class="form-control"
						       name="SECOND_NAME"
						       value="<?= $arResult["arUser"]["SECOND_NAME"] ?>"
						       placeholder="<?= Loc::getMessage('SECOND_NAME') ?>">
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="form-group">
						<input type="EMAIL" class="form-control"
						       value="<?= $arResult["arUser"]["EMAIL"] ?>"
						       placeholder="<?= Loc::getMessage('EMAIL') ?>">
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="form-group">
						<input type="tel" class="form-control"
						       name="PERSONAL_PHONE"
						       value="<?= $arResult["arUser"]['PERSONAL_PHONE'] ?>"
						       placeholder="<?= Loc::getMessage('TQ_PERSONAL_DATA_PHONE'); ?>">
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="form-group">
						<input type="text"
						       class="form-control"
						       name="WORK_COMPANY"
						       value="<?= $arResult["arUser"]['WORK_COMPANY'] ?>"
						       required
						       placeholder="<?= Loc::getMessage('TQ_PERSONAL_DATA_ORGANIZATION_NAME'); ?>*">
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="form-group">
						<input type="text" name="UF_INN" required class="form-control"
						       value="<?= $arResult["arUser"]['UF_INN'] ?>"
						       placeholder="<?= Loc::getMessage('TQ_PERSONAL_DATA_INN'); ?>*">
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="form-group">
						<input type="text" name="UF_KPP" required class="form-control"
						       value="<?= $arResult["arUser"]['UF_KPP'] ?>"
						       placeholder="<?= Loc::getMessage('TQ_PERSONAL_DATA_KPP'); ?>*">
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="form-group">
						<input type="text" class="form-control" required name="UF_OGRN"
						       value="<?= $arResult["arUser"]['UF_OGRN'] ?>"
						       placeholder="<?= Loc::getMessage('TQ_PERSONAL_DATA_OGRN'); ?>*">
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="form-group">
						<input type="text" class="form-control" required name="UF_BIK"
						       value="<?= $arResult["arUser"]['UF_BIK'] ?>"
						       placeholder="<?= Loc::getMessage('TQ_PERSONAL_DATA_BIK'); ?>*">
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="form-group">
						<input type="text" class="form-control" required name="UF_BILL"
						       value="<?= $arResult["arUser"]['UF_BILL'] ?>"
						       placeholder="<?= Loc::getMessage('TQ_PERSONAL_DATA_BILL'); ?>*">
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<label class="switch-box">
						<input type="hidden" name="UF_MARKETING" value="0">
						<input type="checkbox" name="UF_MARKETING"
                            <? if ($arResult["arUser"]["UF_MARKETING"]) { ?> checked<? } ?>
							   hidden
							   value="1">
						<div class="switch-btn<?
                        if ($arResult["arUser"]["UF_MARKETING"]) { ?> switch-on<?
                        } ?>"></div>
						<span class="text"><?= Loc::getMessage('TQ_PERSONAL_DATA_GET_NEWS'); ?></span>
					</label>
				</div>
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<input type="text" name="PERSONAL_STREET" value="<?= $arResult["arUser"]['PERSONAL_STREET'] ?>"
						       class="form-control" placeholder="<?= Loc::getMessage('TQ_PERSONAL_DATA_ADDRESS'); ?>">
					</div>
				</div>
                <?
            }
            ?>
		</div>
		<input name="save" type="submit" class="personal-data_form-submit main-btn_mod"
		       value="<?= Loc::getMessage('TQ_PERSONAL_DATA_SAVE_CHANGES'); ?>">
	</form>
	<script>
        BX.Sale.PrivateProfileComponent.init();
	</script>
</div>