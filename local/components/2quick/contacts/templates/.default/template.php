<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

?>
<div class="unified-inner_section">
	<div class="container">
		<ul class="breadcrumbs">
            <? $APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "breadcrumbs",
                Array(
                    "PATH" => "",
                    "SITE_ID" => SITE_ID,
                    "START_FROM" => "0"
                )
            ); ?>
		</ul>
		<h1><?= $APPLICATION->ShowTitle(false); ?></h1>
		<div id="map"></div>
		<div class="contact-content">
			<div class="contact-content_header">
                <? if (!empty($arResult['TITLE'])) { ?>
					<div class="section-title"><?= $arResult['TITLE']; ?></div>
                <? } ?>
                <? if (!empty($arResult['SUBTITLE'])) { ?>
					<span class="text"><?= $arResult['SUBTITLE']; ?></span>
                <? } ?>
			</div>
			<div class="row contact-row">
                <? if (!empty($arResult['PHONES'])) { ?>
					<div class="col-md-4">
						<div class="contact-subtitle">
							<span class="ico-phone"></span>
                            <?= GetMessage('TQ_CONTACTS_PHONES'); ?>:
						</div>
                        <? foreach ($arResult['PHONES'] as $key => $arPhone) { ?>
							<a href="tel:<?= $arPhone['PHONE']; ?>"><?= $arPhone['FORMATED']; ?></a>
                            <? if ($key + 1 < count($arResult['PHONES'])) { ?>
								<span class="separator"></span>
                            <? } ?>
                        <? } ?>
					</div>
                <? } ?>
                <? if (!empty($arResult['ADDRESS'])) { ?>
					<div class="col-md-4 center-column">
						<div class="contact-subtitle"><span
									class="ico-adress"></span><?= GetMessage('TQ_CONTACTS_ADDRESS'); ?>:
						</div>
						<span class="medium-text"><?= $arResult['ADDRESS']; ?></span>
					</div>
                <? } ?>
				<div class="col-md-4 right-column tablet-small_hidden">
					<a href="#callback" data-toggle="modal"
					   class="gray-mod_btn"><?= GetMessage('TQ_CONTACTS_CONNECT'); ?></a>
				</div>
			</div>
            <? if (!empty($arResult['EMAILS'])) { ?>
				<div class="contact-subtitle">
					<span class="ico-mail"></span>
                    <?= GetMessage('TQ_CONTACTS_SEND_TO_US'); ?>:
				</div>
				<div class="row contact-bottom_row">
                    <? $cnt = 0; ?>
                    <? foreach ($arResult['EMAILS'] as $arEmail) { ?>
						<div class="col-md-4<? if ($cnt == 1) { ?> center-column<? } ?><? if ($cnt == 2) { ?> right-column<? } ?>">
                            <? if ($cnt == 2){ ?>
							<div class="right-column_content"><? } ?>
								<div class="contact-email">
									<a href="mailto:<?= $arEmail['EMAIL']; ?>"><?= $arEmail['EMAIL']; ?></a>
								</div>
                                <?= $arEmail['DESCRIPTION']; ?>
                                <? if ($cnt == 2){ ?></div><? } ?>
						</div>
                        <? $cnt++;
                        if ($cnt > 2) {
                            $cnt = 0;
                        }
                    } ?>
				</div>
            <? } ?>
			<div class="tablet-small_visible">
				<a href="#callback" data-toggle="modal"
				   class="main-btn_mod"><?= GetMessage('TQ_CONTACTS_CONNECT'); ?></a>
			</div>
		</div>
	</div>
</div>
<!-- end unidied-inner_section -->
<script>
    <?if(!empty($arResult['MAP_COORDS'])){?>
    var tqContactsCoords = [<?=$arResult['MAP_COORDS'];?>];
    <?}?>
    <?if(!empty($arResult['MAP_BALLOONS'])){?>
    var tqContactsCoordsDescription = "<?=$arResult['MAP_BALLOONS'];?>";
    <?}?>
</script>