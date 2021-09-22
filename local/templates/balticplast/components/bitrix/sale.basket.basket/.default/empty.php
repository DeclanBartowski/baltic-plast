<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

?>

<div class="no-active_purchases">
	<span class="ico-basket no-active_icon"></span>
	<div class="h3"><?= GetMessage('TQ_BASKET_IS_EMPTY'); ?></div>
	<p><?= GetMessage('TQ_BASKET_MOVE_TO_CATALOG'); ?> </p>
	<a href="<?= $arParams['EMPTY_BASKET_HINT_PATH']; ?>"
	   class="main-btn_mod"><?= GetMessage('TQ_BASKET_GO_TO_CATALOG'); ?>
		<span class="ico-arrow"></span>
	</a>
</div>

<!-- end unidied-inner_section -->