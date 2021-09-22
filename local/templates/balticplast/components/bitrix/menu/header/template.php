<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>

<? if (!empty($arResult)): ?>
	<nav class="head-nav">
		<ul class="head-menu">
            <?
            foreach ($arResult as $arItem):
                if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) {
                    continue;
                }
                ?>
				<li>
					<a href="<?= $arItem["LINK"] ?>"<? if (!empty($arItem['PARAMS']['ADDITIONAL_CLASS'])) {
                        ?> class="<?= $arItem['PARAMS']['ADDITIONAL_CLASS']; ?>"<? } ?>>
                        <? if ($arItem['PARAMS']['IS_CATALOG'] == 'Y') {
                            ?>
							<span class="ico-catalog"></span>
                        <? } ?>
                        <? if (!empty($arItem['PARAMS']['ICON'])) {
                            ?>
							<span class="head-menu_icon">
				            <img data-src="<?= $arItem['PARAMS']['ICON']; ?>"
				                 alt="<?= $arItem['TEXT']; ?>">
			                </span>
                        <? } ?>
                        <?= $arItem['TEXT']; ?>
					</a>
				</li>
            <? endforeach ?>
		</ul>
	</nav>
<? endif ?>
