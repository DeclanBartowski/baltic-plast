<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!is_array($arResult["arMap"]) || count($arResult["arMap"]) < 1) {
    return;
}

$arRootNode = Array();
foreach ($arResult["arMap"] as $index => $arItem) {
    if ($arItem["LEVEL"] == 0) {
        $arRootNode[] = $index;
    }
}

$allNum = count($arRootNode);
$colNum = ceil($allNum / $arParams["COL_NUM"]);

$arResult['MAP_ITEMS'] = array_chunk($arResult['arMap'], count($arResult['arMap']) / 2);
?>

<div class="site-map_section">
	<div class="container">
		<h1 class="text-center"><?= GetMessage('TQ_SITE_MAP_TITLE'); ?></h1>
		<div class="container">
			<div class="row">
                <? foreach ($arResult['MAP_ITEMS'] as $chink) { ?>
					<div class="col-md-6">
						<ul class="site-map_menu">
                            <? foreach ($chink as $arItem) { ?>
								<li><a href="<?= $arItem['FULL_PATH']; ?>" target="_blank"><?= $arItem['NAME']; ?></a>
								</li>
                            <? } ?>
						</ul>
					</div>
                <? } ?>
			</div>
		</div>
	</div>
</div>
