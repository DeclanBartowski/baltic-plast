<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

foreach ($arResult['ITEMS'] as &$arItem) {
    foreach ($arItem['PROPERTIES']['SLIDER']['VALUE'] as $intPicID) {
        $arFileTmp = CFile::ResizeImageGet(
            $intPicID,
            ['width' => 430, 'height' => 350],
            BX_RESIZE_IMAGE_PROPORTIONAL
        );
        $arItem['SLIDER'][] = ['SRC' => $arFileTmp['src']];
    }

}
unset($arItem);
?>