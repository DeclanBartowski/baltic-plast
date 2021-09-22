<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y'); ?>

<div class="row">
	<div class="col-xl-7 col-lg-6 col-md-6 col-10 head_left-column">
		<div class="hamburger hamburger--spring">
			<div class="hamburger-box">
				<div class="hamburger-inner"></div>
			</div>
		</div>
		<div class="head-logo">
			<a<? if ($APPLICATION->GetCurPage(false) != SITE_DIR) { ?> href="<?= SITE_DIR ?>"<? } ?>>
				<img data-src="<?= SITE_TEMPLATE_PATH ?>/img/static/logo.svg" alt="alt">
			</a>
		</div>
		<form action="<?= SITE_DIR ?>search/" class="form-search tablet-small_hidden">
			<input type="text" class="form-search_input" name="q" value="<?= $_REQUEST['q']; ?>"
			       placeholder="<?= GetMessage('TQ_HEADER_BASKET_SEARCH'); ?>">
			<div class="wrapper_form-search_submit">
				<span class="ico-search"></span>
				<input type="submit" class="form-search_submit" value="">
			</div>
		</form>
	</div>
	<div class="col-xl-5 col-lg-6 col-md-6 col-2 head_right-column">
        <? if ($USER->IsAuthorized()) { ?>
			<a href="<?= $arParams['PATH_TO_PERSONAL']; ?>" class="head-login tablet-small_hidden">
							<span class="ico-user"><span class="path1"></span><span class="path2"></span><span
										class="path3"></span><span class="path4"></span><span
										class="path5"></span></span><?= $USER->GetEmail()/*GetMessage('TQ_HEADER_BASKET_PERSONAL')*/; ?>
			</a>
        <? } else { ?>
			<a href="#login" data-toggle="modal" class="head-login tablet-small_hidden">
							<span class="ico-user"><span class="path1"></span><span class="path2"></span><span
										class="path3"></span><span class="path4"></span><span
										class="path5"></span></span><?= GetMessage('TQ_HEADER_BASKET_AUTH'); ?>
			</a>
        <? } ?>
		<div class="head_basket-switch">
			<a href="<?= $arParams['PATH_TO_BASKET']; ?>" class="head-basket">
				<span class="ico-basket"></span>
				<span class="head-basket_number"><?= $arResult['NUM_PRODUCTS']; ?></span>
			</a>
			<span class="separator tablet-small_hidden"></span>
			<div class="switch-language tablet-small_hidden">
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
		</div>
	</div>
</div>