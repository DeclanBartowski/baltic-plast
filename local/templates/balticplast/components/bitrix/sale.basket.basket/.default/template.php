<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\UI\Extension::load("ui.fonts.ruble");

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var string $templateName
 * @var CMain $APPLICATION
 * @var CBitrixBasketComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $giftParameters
 */

?>
<div class="unified-inner_section">
	<div class="container ">
		<ul class="breadcrumbs">
            <? $APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "breadcrumbs",
                Array(
                    "ADDITIONAL_CLASS" => " breadcrumbs-mod",
                    "PATH" => "",
                    "SITE_ID" => SITE_ID,
                    "START_FROM" => "0"
                )
            ); ?>
		</ul>
		<h1><?= $APPLICATION->ShowTitle(false); ?></h1>
		<div class="tq-basket-container">
            <? if ($_REQUEST['tqAjax'] == 'Y') { ?>
                <? $GLOBALS['APPLICATION']->RestartBuffer(); ?>
            <? } ?>
            <?
            if (empty($arResult['ERROR_MESSAGE'])) { ?>
				<div class="wrapper_empty-trash_btn mobile-hidden">
					<a href="javascript:void(0)" data-action="clear_basket" class="empty-trash_btn"><span
								class="ico-close"></span><?= GetMessage('TQ_BASKET_CLEAR'); ?></a>
				</div>
				<div class="row">
					<div class="col-xl-9 cart_left-column">
						<form action="" method="get" class="main_form-search">
							<input type="text" class="main_form-search_input" name="q"
							       value="<?= $_REQUEST['q']; ?>"
							       placeholder="<?= GetMessage('TQ_BASKET_SEARCH'); ?>">
							<div class="wrapper-submit">
								<span class="ico-search"></span>
								<input type="submit" class="main_form-search_submit" value="">
							</div>
							<span class="form-search_delete-btn ico-close"></span>
						</form>
						<div class="wrapper_empty-trash_btn mobile-visible">
							<a href="javascript:void(0)" data-action="clear_basket" class="empty-trash_btn">
								<span class="ico-close"></span>
                                <?= GetMessage('TQ_BASKET_CLEAR'); ?>
							</a>
						</div>
						<table class="basket-table">
							<tr>
								<th><?= GetMessage('TQ_BASKET_PRODUCT_TITLE'); ?></th>
								<th><?= GetMessage('TQ_BASKET_ARTNUMBER'); ?></th>
								<th><?= GetMessage('TQ_BASKET_QUANTITY'); ?></th>
								<th><?= GetMessage('TQ_BASKET_LENGTH'); ?></th>
								<th><?= GetMessage('TQ_BASKET_PRICE'); ?></th>
							</tr>
                            <? foreach ($arResult['ITEMS']['AnDelCanBuy'] as $arItem) {
                                if ($arResult['SEARCH'] == 'Y' && $arItem['SEARCHED'] != 'Y') {
                                    continue;
                                } ?>
								<tr>
									<td>
									<span data-id="<?= $arItem['ID']; ?>" data-action="delete"
									      class="basket-item_delete-btn ico-close"></span>
										<div class="basket-item">
											<a href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
												<div class="basket-item_img">
													<img src="<?= $arItem['PREVIEW_PICTURE_SRC']; ?>"
													     alt="<?= $arItem['NAME']; ?>">
												</div>
												<div class="basket-item_desc">
													<span class="basket-item_title"><?= $arItem['NAME']; ?></span>
													<div class="basket-item_price"><?= $arItem["PRICE_FORMATED"]; ?> <?= $arItem['MEASURE_NAME']; ?></div>
												</div>
											</a>
										</div>
									</td>
									<td>
										<span class="mobile-title"><?= GetMessage('TQ_BASKET_ARTNUMBER'); ?></span><?= $arItem['PROPERTY_ARTNUMBER_VALUE']; ?>
									</td>
									<td>
										<span class="mobile-title"><?= GetMessage('TQ_BASKET_QUANTITY'); ?></span>
										<div class="wrapper-counter-btn">
											<button class="counter-back"></button>
											<input type="text"
											       data-msg="<?= GetMessage('TQ_BASKET_INPUT_QUANTITY') ?>"
											       value="<?= $arItem['QUANTITY'] . ' ' . GetMessage('TQ_BASKET_INPUT_QUANTITY'); ?>"
											       data-id="<?= $arItem['ID']; ?>"
											       data-action="updatebasket"
											       data-langth="<?= $arItem['LENGTH']['NUM']; ?>"
											       data-measure="<?= $arItem['LENGTH']['MEASURE']; ?>"
											       class="product-count">
											<button class="counter-forward"></button>
										</div>
                                        <? if (!empty($arItem['PROPERTY_MINIMUM_VALUE'])) { ?>
											<div class="basket-item_attention">
												<span class="icon">!</span><?= GetMessage('TQ_BASKET_MINIMUM',
                                                    [
                                                        '#COUNT_MEASURE#' => $arItem['PROPERTY_MINIMUM_VALUE'],
                                                        '#COUNT#' => $arItem['PROPERTY_MINIMUM_VALUE']
                                                    ]); ?>
											</div>
                                        <? } ?>
									</td>
									<td>
										<span class="mobile-title"><?= GetMessage('TQ_BASKET_LENGTH'); ?></span>
										<div class="wrapper_basket-item_size">
											<span class="text"><?= GetMessage('TQ_BASKET_LENGTH'); ?>:</span>
											<span class="basket-item_size"><?= GetMessage('TQ_BASKET_LENGTH_NUMBER',
                                                    [
                                                        '#LENGTH#' => sprintf('%s %s',
                                                            $arItem['QUANTITY'] * $arItem['LENGTH']['NUM'],
                                                            $arItem['LENGTH']['MEASURE'])
                                                    ]) ?></span>
											<span class="basket-item_size-delete ico-close"></span>
										</div>
									</td>
									<td><span class="mobile-title"><?= GetMessage('TQ_BASKET_PRICE'); ?></span>
                                        <?= $arItem['SUM']; ?>
									</td>
								</tr>
                            <? } ?>
						</table>
					</div>
					<div class="col-xl-3 cart_right-column">
						<div class="cart-total_box">
							<div class="cart-total_content">
								<a href="<?= $arParams['PATH_TO_ORDER']; ?>" class="main-btn checkout-btn"><span
											class="ico-basket"></span><?= GetMessage('TQ_BASKET_TO_ORDER'); ?></a>
								<table class="cart-total_table">
									<tr>
										<td><?= GetMessage('TQ_BASKET_PRODUCTS_IN_BASKET'); ?></td>
										<td><?= $arResult['PRODUCTS_COUNT_FORMATED']; ?></td>
									</tr>
									<tr class="bold-row">
										<td><?= GetMessage('TQ_BASKET_PRODUCTS_SUM'); ?></td>
										<td><span class="cart-total_sum"><?= $arResult['allSum_FORMATED'] ?></span></td>
									</tr>
								</table>
							</div>
							<div class="bottom-text"><?= GetMessage('TQ_BASKET_PRIVACY'); ?></div>
						</div>
					</div>
				</div>
                <?
            } elseif ($arResult['EMPTY_BASKET']) {
                include(Main\Application::getDocumentRoot() . $templateFolder . '/empty.php');
            } else {
                ShowError($arResult['ERROR_MESSAGE']);
            } ?>
            <? if ($_REQUEST['tqAjax'] == 'Y') { ?>
                <? die(); ?>
            <? } ?>
		</div>
	</div>
</div>
