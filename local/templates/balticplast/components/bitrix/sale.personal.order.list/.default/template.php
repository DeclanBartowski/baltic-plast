<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main,
    Bitrix\Main\Localization\Loc;


Loc::loadMessages(__FILE__);

if (!empty($arResult['ERRORS']['FATAL'])) {
    foreach ($arResult['ERRORS']['FATAL'] as $error) {
        ShowError($error);
    }
    $component = $this->__component;
    if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED])) {
        $APPLICATION->AuthForm('', false, false, 'N', false);
    }

} else {
    ?>
	<div class="personal-area_section">
		<div class="container">
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
			<div class="personal-area_header">
                <?
                $nothing = !isset($_REQUEST["filter_history"]) && !isset($_REQUEST["show_all"]);
                $clearFromLink = array("filter_history", "filter_status", "show_all", "show_canceled");
                ?>
				<ul class="personal-area_menu">
					<li<?
                    if ($_REQUEST["filter_history"] != 'Y') { ?> class="active"<?
                    } ?>>
						<a href="<?= $APPLICATION->GetCurPageParam("", $clearFromLink, false) ?>">
                            <?= Loc::getMessage('SPOL_TPL_ORDERS_CURRENT_HEADER'); ?>
						</a>
					</li>
					<li<?
                    if ($_REQUEST["filter_history"] == 'Y' && $_REQUEST["show_canceled"] != 'Y') { ?> class="active"<?
                    } ?>>
						<a href="<?= $APPLICATION->GetCurPageParam("filter_history=Y", $clearFromLink, false) ?>">
                            <?= Loc::getMessage('SPOL_TPL_ORDERS_HISTORY_HEADER'); ?>
						</a>
					</li>
					<li<?
                    if ($_REQUEST["filter_history"] == 'Y' && $_REQUEST["show_canceled"] == 'Y') { ?> class="active"<?
                    } ?>>
						<a href="<?= $APPLICATION->GetCurPageParam("filter_history=Y&show_canceled=Y", $clearFromLink,
                            false) ?>">
                            <?= Loc::getMessage('SPOL_TPL_ORDERS_CANCELED_HEADER'); ?>
						</a>
					</li>
				</ul>
			</div>

            <?
            if (!empty($arResult['ERRORS']['NONFATAL'])) {
                foreach ($arResult['ERRORS']['NONFATAL'] as $error) {
                    ShowError($error);
                }
            }
            ?>
            <?
            if (!count($arResult['ORDERS'])) {
                ?>
				<div class="no-active_purchases">
					<span class="ico-basket no-active_icon"></span>
                    <?

                    if (!count($arResult['ORDERS'])) {
                        if ($_REQUEST["filter_history"] == 'Y') {
                            if ($_REQUEST["show_canceled"] == 'Y') {
                                ?>
								<div class="h3"><?= Loc::getMessage('SPOL_TPL_EMPTY_CANCELED_ORDER') ?></div>
                                <?
                            } else {
                                ?>
								<div class="h3"><?= Loc::getMessage('SPOL_TPL_EMPTY_HISTORY_ORDER_LIST') ?></div>
                                <?
                            }
                        } else {
                            ?>
							<div class="h3"><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST') ?></div>
                            <?
                        }
                    }
                    ?>
					<p><?= Loc::getMessage('SPOL_TPL_TEXT_TO_CATALOG'); ?> </p>
					<a href="<?= htmlspecialcharsbx($arParams['PATH_TO_CATALOG']) ?>"
					   class="main-btn_mod"><?= Loc::getMessage('SPOL_TPL_LINK_TO_CATALOG') ?> <span
								class="ico-arrow"></span>
					</a>
				</div>
                <?
            }

            if ($_REQUEST["filter_history"] !== 'Y') {
                $paymentChangeData = array();
                $orderHeaderStatus = null;

                foreach ($arResult['ORDERS'] as $key => $order) { ?>
					<div class="order-item">
						<table class="order-item_table">
							<thead>
							<tr>
								<th>
									<span class="order-item_th-subtitle"><?= Loc::getMessage('TQ_ORDER_NAME'); ?></span>№ <?= $order['ORDER']['ACCOUNT_NUMBER']; ?>
								</th>
								<th>
									<span class="order-item_th-subtitle"><?= Loc::getMessage('TQ_ORDER_DATE'); ?></span><?= $order['ORDER']['DATE_INSERT']->format('j.m.Y'); ?>
								</th>
								<th>
									<span class="order-item_th-subtitle"><?= Loc::getMessage('TQ_ORDER_STATUS'); ?></span>
									<span class="order-item_status<?
                                    if ($order['ORDER']['CANCELED'] == 'Y') { ?> canceled<? } else { ?> submitted<?
                                    } ?>">
										<?
                                        if ($order['ORDER']['CANCELED'] == 'Y') {
                                            echo Loc::getMessage('TQ_ORDER_CANCELED');
                                        } else {
                                            if ($arStatus = CSaleStatus::GetByID($order['ORDER']['STATUS_ID'])) {
                                                echo htmlspecialcharsbx($arStatus['NAME']);
                                            }
                                        }
                                        ?>
									</span>
								</th>
								<?
                                $flDiscountSumm = 0;
								foreach ($order['BASKET_ITEMS'] as $arItem) {
									$flDiscountSumm += $arItem['DISCOUNT_PRICE'];
								}
								?>
								<th>
									<span class="order-item_th-subtitle"><?= Loc::getMessage('TQ_ORDER_DISCOUNT_SUM'); ?></span>
                                    <?= CurrencyFormat($flDiscountSumm,
                                        $order['ORDER']['CURRENCY']); ?>
								</th>
								<th>
									<span class="order-item_th-subtitle"><?= Loc::getMessage('TQ_ORDER_SUM'); ?></span>
                                    <?= $order['ORDER']['FORMATED_PRICE']; ?>
								</th>
								<th>
									<div class="order-item_th-flex">
										<a href="<?= SITE_DIR ?>personal/payment.php?pdf=Y&ORDER_ID=<?= $order['ORDER']['ID'] ?>"
										   target="_blank" class="download-invoice_btn">
                                            <?= Loc::getMessage('TQ_ORDER_DOWNLOAD_BILL'); ?>
										</a>
										<span class="order-item_th-collapse-btn"></span>
										<span class="order-item_mobile-btn">
											<span class="text">
												<?= Loc::getMessage('TQ_ORDER_CLOSE'); ?>
											</span>
										</span>
									</div>
								</th>
							</tr>
							</thead>
							<tbody class="order-item_content">
							<tr class="order-item_title-row">
								<td><?= Loc::getMessage('TQ_ORDER_PRODUCT'); ?></td>
								<td><?= Loc::getMessage('TQ_ORDER_ARTNUMBER'); ?></td>
								<td><?= Loc::getMessage('TQ_ORDER_QUANTITY'); ?></td>
								<td><?= Loc::getMessage('TQ_ORDER_DISCOUNT'); ?></td>
								<td><?= Loc::getMessage('TQ_ORDER_PRICE'); ?></td>
								<td></td>
							</tr>
							<tr class="order-item_mobile-row">
								<td colspan="6">
									<span class="order-item_mobile-title">
										<?= Loc::getMessage('TQ_ORDER_CONSIST'); ?>
									</span>
								</td>
							</tr>
                            <?
                            foreach ($order['BASKET_ITEMS'] as $arItem) { ?>
								<tr>
									<td>
										<div class="order-item_product">
											<a href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
												<div class="order-item_product-img">
													<img src="<?= $arItem['PRODUCT_INFO']['PICTURE']; ?>"
													     alt="<?= $arItem['NAME']; ?>">
												</div>
												<div class="order-item_product-desc">
													<span class="mobile-title"><?= Loc::getMessage('TQ_ORDER_PRODUCT'); ?></span>
													<span class="order-item_product-title"><?= $arItem['NAME']; ?></span>
													<div class="order-item_product-price"><?= CurrencyFormat($arItem['PRICE'],
                                                            $arItem['CURRENCY']); ?>
														/ <?= $arItem['MEASURE_NAME']; ?></div>
												</div>
											</a>
										</div>
									</td>
									<td>
										<span class="mobile-title"><?= Loc::getMessage('TQ_ORDER_ARTNUMBER'); ?></span><?= $arItem['PRODUCT_INFO']['ARTNUMBER']; ?>
									</td>
									<td>
										<span class="mobile-title"><?= Loc::getMessage('TQ_ORDER_QUANTITY'); ?></span><?= $arItem['QUANTITY']; ?> <?= Loc::getMessage('TQ_ORDER_PRODUCT_MEASURE'); ?>
									</td>
									<td>
										<span class="mobile-title"><?= Loc::getMessage('TQ_ORDER_DISCOUNT'); ?></span>-<?= CurrencyFormat($arItem['DISCOUNT_PRICE'],
                                            $arItem['CURRENCY']); ?></td>
									<td>
										<span class="mobile-title"><?= Loc::getMessage('TQ_ORDER_PRICE'); ?></span><?= CurrencyFormat($arItem['PRICE'] * $arItem['QUANTITY'],
                                            $arItem['CURRENCY']); ?> / <?= $arItem['MEASURE_NAME']; ?></td>
									<td></td>
								</tr>
                                <?
                            } ?>
							</tbody>
						</table>
					</div>
                    <?
                }
            } else {
                $orderHeaderStatus = null;

                foreach ($arResult['ORDERS'] as $key => $order) { ?>
					<div class="order-item">
						<table class="order-item_table">
							<thead>
							<tr>
								<th>
									<span class="order-item_th-subtitle"><?= Loc::getMessage('TQ_ORDER_NAME'); ?></span>№ <?= $order['ORDER']['ACCOUNT_NUMBER']; ?>
								</th>
								<th>
									<span class="order-item_th-subtitle"><?= Loc::getMessage('TQ_ORDER_DATE'); ?></span><?= $order['ORDER']['DATE_INSERT']->format('j.m.Y'); ?>
								</th>
								<th>
									<span class="order-item_th-subtitle"><?= Loc::getMessage('TQ_ORDER_STATUS'); ?></span>
									<span class="order-item_status<?
                                    if ($order['ORDER']['CANCELED'] == 'Y') { ?> canceled<? } else { ?> submitted<?
                                    } ?>">
										<?
                                        if ($order['ORDER']['CANCELED'] == 'Y') {
                                            echo Loc::getMessage('TQ_ORDER_CANCELED');
                                        } else {
                                            if ($arStatus = CSaleStatus::GetByID($order['ORDER']['STATUS_ID'])) {
                                                echo htmlspecialcharsbx($arStatus['NAME']);
                                            }
                                        }
                                        ?>
									</span>
								</th>
								<th>
									<span class="order-item_th-subtitle"><?= Loc::getMessage('TQ_ORDER_DISCOUNT_SUM'); ?></span>
                                    <?= CurrencyFormat($order['ORDER']['DISCOUNT_VALUE'],
                                        $order['ORDER']['CURRENCY']); ?>
								</th>
								<th>
									<span class="order-item_th-subtitle"><?= Loc::getMessage('TQ_ORDER_SUM'); ?></span>
                                    <?= $order['ORDER']['FORMATED_PRICE']; ?>
								</th>
								<th>
									<div class="order-item_th-flex">
										<a href="<?= htmlspecialcharsbx($order["ORDER"]["URL_TO_COPY"]); ?>"
										   class="repeat-order_btn">
											<span class="ico-load"></span>
                                            <?= Loc::getMessage('SPOL_TPL_REPEAT_ORDER'); ?>
										</a>
										<span class="order-item_th-collapse-btn"></span>
										<span class="order-item_mobile-btn">
											<span class="text">
												<?= Loc::getMessage('TQ_ORDER_CLOSE'); ?>
											</span>
										</span>
									</div>
								</th>
							</tr>
							</thead>
							<tbody class="order-item_content">
							<tr class="order-item_title-row">
								<td><?= Loc::getMessage('TQ_ORDER_PRODUCT'); ?></td>
								<td><?= Loc::getMessage('TQ_ORDER_ARTNUMBER'); ?></td>
								<td><?= Loc::getMessage('TQ_ORDER_QUANTITY'); ?></td>
								<td><?= Loc::getMessage('TQ_ORDER_DISCOUNT'); ?></td>
								<td><?= Loc::getMessage('TQ_ORDER_PRICE'); ?></td>
								<td></td>
							</tr>
							<tr class="order-item_mobile-row">
								<td colspan="6">
									<span class="order-item_mobile-title">
										<?= Loc::getMessage('TQ_ORDER_CONSIST'); ?>
									</span>
								</td>
							</tr>
                            <?
                            foreach ($order['BASKET_ITEMS'] as $arItem) { ?>
								<tr>
									<td>
										<div class="order-item_product">
											<a href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
												<div class="order-item_product-img">
													<img src="<?= $arItem['PRODUCT_INFO']['PICTURE']; ?>"
													     alt="<?= $arItem['NAME']; ?>">
												</div>
												<div class="order-item_product-desc">
													<span class="mobile-title"><?= Loc::getMessage('TQ_ORDER_PRODUCT'); ?></span>
													<span class="order-item_product-title"><?= $arItem['NAME']; ?></span>
													<div class="order-item_product-price"><?= CurrencyFormat($arItem['PRICE'],
                                                            $arItem['CURRENCY']); ?>
														/ <?= $arItem['MEASURE_NAME']; ?></div>
												</div>
											</a>
										</div>
									</td>
									<td>
										<span class="mobile-title"><?= Loc::getMessage('TQ_ORDER_ARTNUMBER'); ?></span><?= $arItem['PRODUCT_INFO']['ARTNUMBER']; ?>
									</td>
									<td>
										<span class="mobile-title"><?= Loc::getMessage('TQ_ORDER_QUANTITY'); ?></span><?= $arItem['QUANTITY']; ?> <?= Loc::getMessage('TQ_ORDER_PRODUCT_MEASURE'); ?>
									</td>
									<td>
										<span class="mobile-title"><?= Loc::getMessage('TQ_ORDER_DISCOUNT'); ?></span>-<?= CurrencyFormat($arItem['DISCOUNT_PRICE'],
                                            $arItem['CURRENCY']); ?></td>
									<td>
										<span class="mobile-title"><?= Loc::getMessage('TQ_ORDER_PRICE'); ?></span><?= CurrencyFormat($arItem['PRICE'] * $arItem['QUANTITY'],
                                            $arItem['CURRENCY']); ?> / <?= $arItem['MEASURE_NAME']; ?></td>
									<td></td>
								</tr>
                                <?
                            } ?>
							</tbody>
						</table>
					</div>
                    <?
                }
            }
            ?>
			<div class="clearfix"></div>
            <?
            echo $arResult["NAV_STRING"];

            if ($_REQUEST["filter_history"] !== 'Y') {
                $javascriptParams = array(
                    "url" => CUtil::JSEscape($this->__component->GetPath() . '/ajax.php'),
                    "templateFolder" => CUtil::JSEscape($templateFolder),
                    "templateName" => $this->__component->GetTemplateName(),
                    "paymentList" => $paymentChangeData,
                    "returnUrl" => CUtil::JSEscape($arResult["RETURN_URL"]),
                );
                $javascriptParams = CUtil::PhpToJSObject($javascriptParams);
                ?>
				<script>
                    BX.Sale.PersonalOrderComponent.PersonalOrderList.init(<?=$javascriptParams?>);
				</script>
                <?
            } ?>
		</div>
	</div>
    <?
}
?>
