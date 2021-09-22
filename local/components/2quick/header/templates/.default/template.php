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
<? if ($USER->IsAuthorized()) { ?>
    <? if (!empty($arResult['PATH_TO_PERSONAL'])) { ?>
		<a href="<?= $arResult['PATH_TO_PERSONAL']; ?>" class="head-login">
						<span class="ico-user"><span class="path1"></span><span class="path2"></span><span
									class="path3"></span><span class="path4"></span><span class="path5"></span></span>
			<?=GetMessage('TQ_HEADER_CONTACTS_PERSONAL_LINK');?>
		</a>
    <? } ?>
<? } else { ?>
	<a href="#login" data-toggle="modal" class="head-login">
						<span class="ico-user"><span class="path1"></span><span class="path2"></span><span
									class="path3"></span><span class="path4"></span><span class="path5"></span></span>
		<?=GetMessage('TQ_HEADER_CONTACTS_PERSONAL_AUTH');?>
	</a>
<? } ?>

<? if (!empty($arResult['SITES'])) { ?>
	<div class="switch-language">
		<span class="language-label"><span
					class="ico-globe"></span><?= $arResult['CURRENT_SITE']['LANGUAGE_ID']; ?></span>
		<ul class="switch-language_list">
            <? foreach ($arResult['SITES'] as $arSite) { ?>
				<li<? if (SITE_ID == $arSite['ID']) { ?> class="active"<? } ?>>
					<a href="<?= $arSite['DIR'] ?>"><?= $arSite['LANGUAGE_ID']; ?></a>
				</li>
            <? } ?>
		</ul>
	</div>
<? } ?>
<? if (!empty($arResult['EMAIL'])) { ?>
	<a href="mailto:<?= $arResult['EMAIL']; ?>" class="head-email"><span class="ico-mail"></span><?=GetMessage('TQ_HEADER_CONTACTS_WRITE_TO_US');?></a>
<? } ?>
<? if (!empty($arResult['PHONE'])) { ?>
	<a href="tel:<?= $arResult['PHONE']['PHONE']; ?>" class="head_phone-number">
		<span class="ico-phone"></span><?= $arResult['PHONE']['FORMATED']; ?></a>
<? } ?>

<a href="#callback" data-toggle="modal" class="head-callback"><?=GetMessage('TQ_HEADER_CONTACTS_ORDER_CALL');?></a>

<ul class="social-network head_social-network">
    <? if (!empty($arResult['INST'])) { ?>
		<li><a href="<?= $arResult['INST']; ?>"><span class="ico-inst"></span></a></li>
    <? } ?>
    <? if (!empty($arResult['VK'])) { ?>
		<li><a href="<?= $arResult['VK']; ?>"><span class="ico-vk"></span></a></li>
    <? } ?>
    <? if (!empty($arResult['YOUTUBE'])) { ?>
		<li><a href="<?= $arResult['YOUTUBE']; ?>"><span class="ico-yt"><span class="path1"></span><span
							class="path2"></span><span
							class="path3"></span><span class="path4"></span><span
							class="path5"></span><span class="path6"></span><span
							class="path7"></span></span></a>
		</li>
    <? } ?>
    <? if (!empty($arResult['FACEBOOK'])) { ?>
		<li><a href="<?= $arResult['FACEBOOK']; ?>"><span class="ico-fb"></span></a></li>
    <? } ?>
</ul>
