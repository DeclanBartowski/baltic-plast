<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
</main>
<? if (ERROR_404 != 'Y') { ?>
	<!-- end main-content -->
	<footer class="main-footer">
        <? $APPLICATION->IncludeComponent(
            "2quick:footer",
            "",
            Array(
                "EMAIL" => "email@mail.mai",
                "FACEBOOK" => "https://www.facebook.com/",
                "INST" => "https://www.instagram.com",
                "PATH_TO_PERSONAL" => SITE_DIR . "personal/",
                "PHONE" => "8-800-00-00-00",
                "VK" => "https://vk.com/",
                "YOUTUBE" => "https://www.youtube.com/",
                "STUDIO_LINK" => "/"
            )
        ); ?>
	</footer>
	<!-- end main-footer -->
<? } ?>
<div class="scroll-to-top"></div>
</div>

<div aria-hidden="true" class="modal fade js-modal" id="callback" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<button class="close" data-dismiss="modal" type="button"><span class="ico-close"></span></button>
            <?
            $APPLICATION->IncludeComponent(
                "2quick:main.feedback",
                "",
                Array(
                    "AJAX_MODE" => "Y",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "EMAIL_TO" => "admin@admin.admin",
                    "EVENT_MESSAGE_ID" => array("7"),
                    "INFOBLOCKADD" => "Y",
                    "INFOBLOCKID" => "12",
                    "LINK" => "",
                    "OK_TEXT" => FORM_SUCCESS_TEXT,
                    "REQUIRED_FIELDS" => array(""),
                    "TITLE" => "",
                    "USE_CAPTCHA" => "N"
                )
            ); ?>
		</div>
	</div>
</div>
<!-- end callback -->
<div aria-hidden="true" class="modal fade js-modal" id="login" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<button class="close" data-dismiss="modal" type="button"><span class="ico-close"></span></button>
            <? $APPLICATION->IncludeComponent(
                "2quick:auth",
                "",
                Array()
            ); ?>
		</div>
	</div>
</div>
<!-- end login -->
<div aria-hidden="true" class="modal fade js-modal" id="register" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<button class="close" data-dismiss="modal" type="button"><span class="ico-close"></span></button>
            <? $APPLICATION->IncludeComponent(
                "2quick:registration",
                "",
                Array()
            ); ?>
		</div>
	</div>
</div>
<!-- end register -->
<div aria-hidden="true" class="modal fade js-modal" id="access" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<button class="close" data-dismiss="modal" type="button"><span class="ico-close"></span></button>
            <? $APPLICATION->IncludeComponent(
                "2quick:forgotpassword",
                "",
                Array()
            ); ?>
		</div>
	</div>
</div>
<!-- end access -->
<div aria-hidden="true" class="modal fade js-modal" id="registered-successfully" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<button class="close" data-dismiss="modal" type="button"><span class="ico-close"></span></button>
			<div class="popup-icon"><img data-src="<?= SITE_TEMPLATE_PATH ?>/img/icons/smile-icon.svg" alt="alt"></div>
            <? $APPLICATION->IncludeFile(
                SITE_DIR . "include/modal/registered-successfully.php",
                Array(),
                Array("MODE" => "php")
            ); ?>
		</div>
	</div>
</div>
<!-- end registered successfully -->
<div aria-hidden="true" class="modal fade js-modal" id="password-changed" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<button class="close" data-dismiss="modal" type="button"><span class="ico-close"></span></button>
			<div class="popup-icon"><img data-src="<?= SITE_TEMPLATE_PATH ?>/img/icons/check-icon.svg" alt="alt"></div>
            <? $APPLICATION->IncludeFile(
                SITE_DIR . "include/modal/new_password.php",
                Array(),
                Array("MODE" => "php")
            ); ?>
		</div>
	</div>
</div>
<!-- end password-changed -->
<link href="<?= SITE_TEMPLATE_PATH ?>/css/min.css" rel="stylesheet"/>
<link href="<?= SITE_TEMPLATE_PATH ?>/css/main.css" rel="stylesheet"/>
<link href="<?= SITE_TEMPLATE_PATH ?>/css/costume.css" rel="stylesheet"/>

<script src="<?= SITE_TEMPLATE_PATH ?>/js/min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/main.js"></script>
<script>
    let SITE_DIR = '<?=SITE_DIR?>';
</script>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/costume.js"></script>
</body>
</html>