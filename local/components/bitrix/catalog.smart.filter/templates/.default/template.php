<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$arClasses = [
    0 => 'second-column',
    1 => 'fourth-column',
    2 => 'fifth-column',
];
$cnt = 0;
?>

<form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get"
      class="smartfilter filter-panel">
    <? foreach ($arResult["HIDDEN"] as $arItem): ?>
		<input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
		       value="<? echo $arItem["HTML_VALUE"] ?>"/>
    <? endforeach; ?>
	<div class="column first-column">
		<div class="filter-btn"><span class="ico-filter"></span><?= GetMessage('TQ_FILTER_ALL_FILTERS'); ?></div>
	</div>
    <? foreach ($arResult["ITEMS"] as $key => $arItem) {
        $key = $arItem["ENCODED_ID"];
        if (isset($arItem["PRICE"])):
            if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0) {
                continue;
            }

            $precision = 2;
            if (Bitrix\Main\Loader::includeModule("currency")) {
                $res = CCurrencyLang::GetFormatDescription($arItem["VALUES"]["MIN"]["CURRENCY"]);
                $precision = $res['DECIMALS'];
            }
            ?>
			<div class="column third-column">
				<div class="filter_price-column">
					<span class="filter_price-label"><?= $arItem["NAME"] ?></span>
					<div class="filter_price-dropdown">
						<div class="filter-number filter-number_mod">
							<div class="wrapper_slider-range">
								<div class="slider-range slider-range_vertical"></div>
							</div>
							<div class="field-number_container field-number_container-mod">
								<div class="wrapper_filter-number">
									<input type="text" name="<?
                                    echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
									       value="<?
                                           echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
									       class="field-number price-max"
									       data-number="<?= $arItem["VALUES"]["MAX"]["VALUE"]; ?>"
									       placeholder="<?= $arItem["VALUES"]["MAX"]["VALUE"]/*CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"],
                                               $arItem["VALUES"]["MAX"]["CURRENCY"]);*/ ?>">
								</div>
								<div class="wrapper_filter-number">
									<input type="text"
									       name="<?
                                           echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
									       value="<?
                                           echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
									       class="field-number price-min"
									       data-number="<?= $arItem["VALUES"]["MIN"]["VALUE"]; ?>"
									       placeholder="<?= $arItem["VALUES"]["MIN"]["VALUE"]/*CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"],
                                               $arItem["VALUES"]["MIN"]["CURRENCY"]);*/ ?>">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        <?
            //$cnt++;
        endif;
    } ?>

    <?
    foreach ($arResult["ITEMS"] as $key => $arItem) {
        if ($cnt > 2) {
            break;
        }
        if (
            empty($arItem["VALUES"])
            || isset($arItem["PRICE"])
        ) {
            continue;
        }

        if (
            $arItem["DISPLAY_TYPE"] == "A"
            && (
                $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
            )
        ) {
            continue;
        }
        ?>
        <?
        $arCur = current($arItem["VALUES"]);
        switch ($arItem["DISPLAY_TYPE"]) {
            default://CHECKBOXES
                ?>
				<div class="column <?= $arClasses[$cnt]; ?>">
					<select name="<?= $arCur["CONTROL_NAME_ALT"] ?>" class="js-select">
						<option value=""><?= $arItem['NAME']; ?></option>
                        <?
                        foreach ($arItem["VALUES"] as $val => $ar):?>
							<option
                                <? echo $ar["CHECKED"] ? 'selected' : '' ?>
									value="<? echo $ar["HTML_VALUE_ALT"] ?>">
                                <?= $ar["VALUE"]; ?>
							</option>
                        <? endforeach; ?>
					</select>
				</div>
                <?
                $cnt++;
        }
        ?>
        <?
    }
    ?>
	<div class="column six-column">
		<select class="js-select" name="SORT">
			<option value=""><?= GetMessage('TQ_FILTER_SORT'); ?></option>
			<option <?if($arParams['CURRENT_SORT'] == 'PRICE_ASC') echo 'selected';?> value="PRICE_ASC"><?= GetMessage('TQ_FILTER_SORT_PRICE_ASC'); ?></option>
			<option <?if($arParams['CURRENT_SORT'] == 'PRICE_DESC') echo 'selected';?> value="PRICE_DESC"><?= GetMessage('TQ_FILTER_SORT_PRICE_DESC'); ?></option>
		</select>
	</div>
	<input
			class="btn btn-themes"
			type="hidden"
			id="set_filter"
			name="set_filter"
			value="Y"
	/>
	<input type="hidden" name="submit" value="Y">
</form>


<form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get"
      class="filter-fixed">
    <? foreach ($arResult["HIDDEN"] as $arItem): ?>
		<input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
		       value="<? echo $arItem["HTML_VALUE"] ?>"/>
    <? endforeach; ?>
	<div class="text-right">
		<span class="catalog-filter_close-btn ico-close"></span>
	</div>
	<div class="section-title">
        <?= GetMessage('CT_BCSF_FILTER_TITLE'); ?>
	</div>
	<div class="filter-fixed_body">
        <? foreach ($arResult["ITEMS"] as $key => $arItem) {
            $key = $arItem["ENCODED_ID"];
            if (isset($arItem["PRICE"])):
                if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0) {
                    continue;
                }

                $precision = 2;
                if (Bitrix\Main\Loader::includeModule("currency")) {
                    $res = CCurrencyLang::GetFormatDescription($arItem["VALUES"]["MIN"]["CURRENCY"]);
                    $precision = $res['DECIMALS'];
                }
                ?>
				<div class="catalog-filter_item">
					<div class="catalog-filter_item-title"><?= $arItem['NAME']; ?></div>
					<div class="catalog-filter_item-body">
						<div class="filter-number">
							<div class="field-number_container">
								<div class="wrapper_filter-number">
									<span class="text"><?= GetMessage('TQ_CATALOG_FROM'); ?></span>
									<input type="text" class="field-number price-min"
									       name="<?
                                           echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
									       id="<?
                                           echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
									       value="<?
                                           echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
									       data-number="<? echo $arItem["VALUES"]["MIN"]["VALUE"] ?>"
									       placeholder="<?= $arItem["VALUES"]["MIN"]["VALUE"]/*CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"],
                                               $arItem["VALUES"]["MIN"]["CURRENCY"]);*/ ?>">
								</div>
								<div class="wrapper_filter-number">
									<span class="text"><?= GetMessage('TQ_CATALOG_TO'); ?></span>
									<input type="text" class="field-number price-max"
									       name="<?
                                           echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
									       id="<?
                                           echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
									       value="<?
                                           echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
									       data-number="<? echo $arItem["VALUES"]["MAX"]["VALUE"] ?>"
									       placeholder="<?= $arItem["VALUES"]["MAX"]["VALUE"]/*CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"],
                                               $arItem["VALUES"]["MAX"]["CURRENCY"]);*/ ?>">
								</div>
							</div>
							<div class="slider-range"></div>
                            <?
                            if (!empty($arItem["VALUES"]["MIN"]["HTML_VALUE"]) || !empty($arItem["VALUES"]["MAX"]["HTML_VALUE"])) {
                                ?>
								<div class="filter-number_footer">
									<span class="ico-close"></span>
                                    <?= GetMessage('TQ_CATALOG_SELECTED'); ?>: <span
											class="medium-text"><?= GetMessage('TQ_CATALOG_FROM'); ?>
										<span class="first-price">
											<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>
										</span>
										<?= str_replace('0 ', '',
                                            CurrencyFormat(0, $arItem["VALUES"]["MIN"]["CURRENCY"])) ?>
                                        <?= GetMessage('TQ_CATALOG_TO'); ?>
										<span class="second-price">
											<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>
										</span>
										<?= str_replace('0 ', '',
                                            CurrencyFormat(0, $arItem["VALUES"]["MIN"]["CURRENCY"])) ?>
									</span>
								</div>
                                <?
                            } ?>
						</div>
					</div>
				</div>
            <?
            endif;
        } ?>
        <?
        foreach ($arResult["ITEMS"] as $key => $arItem) {
            if (
                empty($arItem["VALUES"])
                || isset($arItem["PRICE"])
            ) {
                continue;
            }

            if (
                $arItem["DISPLAY_TYPE"] == "A"
                && (
                    $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
                )
            ) {
                continue;
            }
            ?>
            <?
            $arCur = current($arItem["VALUES"]);
            switch ($arItem["DISPLAY_TYPE"]) {
                case "A"://NUMBERS_WITH_SLIDER
                    ?>
					<div class="catalog-filter_item">
						<div class="catalog-filter_item-title"><?= $arItem['NAME']; ?></div>
						<div class="catalog-filter_item-body">
							<div class="filter-number">
								<div class="field-number_container">
									<div class="wrapper_filter-number">
										<span class="text"><?= GetMessage('TQ_CATALOG_FROM'); ?></span>
										<input type="text" class="field-number price-min"
										       name="<?
                                               echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
										       id="<?
                                               echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
										       value="<?
                                               echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
										       data-number="<? echo $arItem["VALUES"]["MIN"]["VALUE"] ?>"
										       placeholder="<?= $arItem["VALUES"]["MIN"]["VALUE"]/*CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"],
                                               $arItem["VALUES"]["MIN"]["CURRENCY"]);*/ ?>">
									</div>
									<div class="wrapper_filter-number">
										<span class="text"><?= GetMessage('TQ_CATALOG_TO'); ?></span>
										<input type="text" class="field-number price-max"
										       name="<?
                                               echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
										       id="<?
                                               echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
										       value="<?
                                               echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
										       data-number="<? echo $arItem["VALUES"]["MAX"]["VALUE"] ?>"
										       placeholder="<?= $arItem["VALUES"]["MAX"]["VALUE"]/*CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"],
                                               $arItem["VALUES"]["MAX"]["CURRENCY"]);*/ ?>">
									</div>
								</div>
								<div class="slider-range"></div>
                                <?
                                if (!empty($arItem["VALUES"]["MIN"]["HTML_VALUE"]) || !empty($arItem["VALUES"]["MAX"]["HTML_VALUE"])) {
                                    ?>
									<div class="filter-number_footer">
										<span class="ico-close"></span>
                                        <?= GetMessage('TQ_CATALOG_SELECTED'); ?>: <span
												class="medium-text"><?= GetMessage('TQ_CATALOG_FROM'); ?>
										<span class="first-price">
											<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>
										</span>
										<?= str_replace('0 ', '',
                                            CurrencyFormat(0, $arItem["VALUES"]["MIN"]["CURRENCY"])) ?>
                                            <?= GetMessage('TQ_CATALOG_TO'); ?>
										<span class="second-price">
											<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>
										</span>
										<?= str_replace('0 ', '',
                                            CurrencyFormat(0, $arItem["VALUES"]["MIN"]["CURRENCY"])) ?>
									</span>
									</div>
                                    <?
                                } ?>
							</div>
						</div>
					</div>
                    <?
                    break;
                case "B"://NUMBERS
                    ?>

					<div class="catalog-filter_item">
						<div class="catalog-filter_item-title"><?= $arItem['NAME']; ?></div>
						<div class="catalog-filter_item-body">
							<div class="filter-number">
								<div class="field-number_container">
									<div class="wrapper_filter-number">
										<span class="text"><?= GetMessage('TQ_CATALOG_FROM'); ?></span>
										<input type="text" class="field-number price-min"
										       name="<?
                                               echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
										       id="<?
                                               echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
										       value="<?
                                               echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
										       data-number="<? echo $arItem["VALUES"]["MIN"]["VALUE"] ?>"
										       placeholder="<?= $arItem["VALUES"]["MIN"]["VALUE"]/*CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"],
                                               $arItem["VALUES"]["MIN"]["CURRENCY"]);*/ ?>">
									</div>
									<div class="wrapper_filter-number">
										<span class="text"><?= GetMessage('TQ_CATALOG_TO'); ?></span>
										<input type="text" class="field-number price-max"
										       name="<?
                                               echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
										       id="<?
                                               echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
										       value="<?
                                               echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
										       data-number="<? echo $arItem["VALUES"]["MAX"]["VALUE"] ?>"
										       placeholder="<?= $arItem["VALUES"]["MAX"]["VALUE"]/*CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"],
                                               $arItem["VALUES"]["MAX"]["CURRENCY"]);*/ ?>">
									</div>
								</div>
								<div class="slider-range"></div>
                                <?
                                if (!empty($arItem["VALUES"]["MIN"]["HTML_VALUE"]) || !empty($arItem["VALUES"]["MAX"]["HTML_VALUE"])) {
                                    ?>
									<div class="filter-number_footer">
										<span class="ico-close"></span>
                                        <?= GetMessage('TQ_CATALOG_SELECTED'); ?>: <span
												class="medium-text"><?= GetMessage('TQ_CATALOG_FROM'); ?>
										<span class="first-price">
											<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>
										</span>
										<?= str_replace('0 ', '',
                                            CurrencyFormat(0, $arItem["VALUES"]["MIN"]["CURRENCY"])) ?>
                                            <?= GetMessage('TQ_CATALOG_TO'); ?>
										<span class="second-price">
											<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>
										</span>
										<?= str_replace('0 ', '',
                                            CurrencyFormat(0, $arItem["VALUES"]["MIN"]["CURRENCY"])) ?>
									</span>
									</div>
                                    <?
                                } ?>
							</div>
						</div>
					</div>
                    <?
                    break;
                case "G"://CHECKBOXES_WITH_PICTURES
                    ?>

					<div class="catalog-filter_item">
						<div class="catalog-filter_item-title"><?= $arItem['NAME']; ?></div>
						<div class="catalog-filter_item-body">
							<ul class="catalog_color-list">
                                <? foreach ($arItem["VALUES"] as $val => $ar): ?>
									<input
											style="display: none"
											type="radio"
											value="<? echo $ar["HTML_VALUE_ALT"] ?>"
											name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
											id="<? echo $ar["CONTROL_ID"] ?>"
                                        <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
									/>
                                    <?
                                    $class = "";
                                    if ($ar["CHECKED"]) {
                                        $class .= " is-active";
                                    }
                                    if ($ar["DISABLED"]) {
                                        $class .= " disabled";
                                    }
                                    ?>
									<li data-input="<?= $ar["CONTROL_ID"] ?>" class="<?= $class ?>"
									    style="background: #<?= $ar['URL_ID']; ?>">
									</li>
                                <? endforeach ?>
                                <?
                                if ($arItem['CODE'] == 'COLOR') {
                                    ?>
									<li data-all="<? echo $arCur["CONTROL_NAME_ALT"] ?>">
										<img data-src="<?= SITE_TEMPLATE_PATH ?>/img/icons/icons-colors.png" alt="">
									</li>
                                    <?
                                } ?>
							</ul>
						</div>
					</div>
                    <?
                    break;

                case "P"://DROPDOWN
                    $checkedItemExist = false;
                    ?>
					<div class="catalog-filter_item">
						<div class="catalog-filter_item-title"><?= $arItem['NAME']; ?></div>
						<div class="catalog-filter_item-body">
							<ul class="catalog-filter_list">
                                <? foreach ($arItem["VALUES"] as $val => $ar): ?>
									<li>
										<label class="unified-checkbox">
											<input type="radio"
											       name="<?= $ar["CONTROL_NAME_ALT"] ?>"
											       id="<?= $ar["CONTROL_ID"] ?>"
											       value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>>
											<span class="checkbox-text"><?= $ar["VALUE"]; ?></span>
										</label>
									</li>
                                <? endforeach; ?>
							</ul>
						</div>
					</div>
                    <?
                    break;
                case "K"://RADIO_BUTTONS
                    ?>
                    <?
                    if ($arItem['CODE'] == 'COLOR') {
                        ?>
						<div class="catalog-filter_item">
							<div class="catalog-filter_item-title"><?= $arItem['NAME']; ?></div>
							<div class="catalog-filter_item-body">
								<ul class="catalog_color-list">
                                    <? foreach ($arItem["VALUES"] as $val => $ar): ?>
										<input
												style="display: none"
												type="radio"
												value="<? echo $ar["HTML_VALUE_ALT"] ?>"
												name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
												id="<? echo $ar["CONTROL_ID"] ?>"
                                            <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
										/>
                                        <?
                                        $class = "";
                                        if ($ar["CHECKED"]) {
                                            $class .= " is-active";
                                        }
                                        if ($ar["DISABLED"]) {
                                            $class .= " disabled";
                                        }
                                        ?>
										<li data-input="<?= $ar["CONTROL_ID"] ?>" class="<?= $class ?>"
										    style="background: #<?= $ar['URL_ID']; ?>">
										</li>
                                    <? endforeach ?>
                                    <?
                                    if ($arItem['CODE'] == 'COLOR') {
                                        ?>
										<li data-all="<? echo $arCur["CONTROL_NAME_ALT"] ?>">
											<img data-src="<?= SITE_TEMPLATE_PATH ?>/img/icons/icons-colors.png" alt="">
										</li>
                                        <?
                                    } ?>
								</ul>
							</div>
						</div>
                    <? } else { ?>
						<div class="catalog-filter_item">
							<div class="catalog-filter_item-title"><?= $arItem['NAME']; ?></div>
							<div class="catalog-filter_item-body">
								<ul class="catalog-filter_list">
                                    <? foreach ($arItem["VALUES"] as $val => $ar): ?>
										<li>
											<label class="unified-checkbox">
												<input type="radio"
												       value="<? echo $ar["HTML_VALUE_ALT"] ?>"
												       name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
												       id="<? echo $ar["CONTROL_ID"] ?>"
                                                    <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>>
												<span class="checkbox-text"><?= $ar["VALUE"]; ?></span>
											</label>
										</li>
                                    <? endforeach; ?>
								</ul>
							</div>
						</div>
                        <?
                    } ?>
                    <?
                    break;
                case "U"://CALENDAR
                    break;
                default://CHECKBOXES
                    ?>
					<div class="catalog-filter_item">
						<div class="catalog-filter_item-title"><?= $arItem['NAME']; ?></div>
						<div class="catalog-filter_item-body">
							<ul class="catalog-filter_list">
                                <? foreach ($arItem["VALUES"] as $val => $ar): ?>
									<li>
										<label class="unified-checkbox">
											<input type="checkbox"
											       value="<? echo $ar["HTML_VALUE"] ?>"
											       name="<? echo $ar["CONTROL_NAME"] ?>"
											       id="<? echo $ar["CONTROL_ID"] ?>"
                                                <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>>
											<span class="checkbox-text"><?= $ar["VALUE"]; ?></span>
										</label>
									</li>
                                <? endforeach; ?>
							</ul>
						</div>
					</div>
                <?
            }
            ?>

            <?
        }
        ?>
	</div>

	<div class="catalog-filter_footer">
		<button type="submit"
		        id="del_filter"
		        name="del_filter"
		        class="catalog-filter_reset-btn"><span class="ico-close"></span><?= GetMessage('CT_BCSF_DEL_FILTER'); ?>
		</button>
		<button
				type="submit"
				id="set_filter"
				name="set_filter"
				value="<?= GetMessage("CT_BCSF_SET_FILTER") ?>"
				class="catalog-filter_apply-btn main-btn"><?= GetMessage('CT_BCSF_SET_FILTER'); ?>
		</button>
	</div>
	<input type="hidden" name="submit" value="Y">
</form>

