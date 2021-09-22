<?

$rsSites = CSite::GetList($by = "sort", $order = "desc", Array());
while ($arSite = $rsSites->Fetch()) {
    $arResult['SITES'][$arSite['ID']] = $arSite;
}
$arResult['CURRENT_SITE'] = $arResult['SITES'][SITE_ID]; ?>