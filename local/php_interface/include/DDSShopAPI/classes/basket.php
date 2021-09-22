<?php

namespace DDS;

use Bitrix\Main\SystemException;
use Bitrix\Main\Loader;
use Bitrix\Main\Web\Json;
use \Bitrix\Iblock\SectionTable;
use Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem;
use Bitrix\Sale;

\CModule::IncludeModule('iblock');
\CModule::IncludeModule("sale");
\CModule::IncludeModule("catalog");

class Basketclass
{

    public static function getProductInfo($id, $quantity)
    {
        global $USER;

        $res = \CIBlockElement::GetByID($id);
        if ($ar_res = $res->GetNext()) {
            $arPrice = \CCatalogProduct::GetOptimalPrice($id, $quantity, $USER->GetUserGroupArray(), 'N');
            $result = array(
                'PRODUCT_ID' => $id,
                'PRODUCT_PRICE_ID' => 0,
                'PRICE' => $arPrice['DISCOUNT_PRICE'],
                'CURRENCY' => $arPrice['CURRENCY'],
                'QUANTITY' => $quantity,
                'LID' => LANG,
                'DELAY' => 'N',
                'CAN_BUY' => 'Y',
                'NAME' => htmlspecialchars_decode($ar_res['NAME']),
                'CALLBACK_FUNC' => 'MyBasketCallback',
                'MODULE' => 'my_module',
                'NOTES' => '',
                'ORDER_CALLBACK_FUNC' => 'MyBasketOrderCallback',
                'DETAIL_PAGE_URL' => $ar_res['DETAIL_PAGE_URL']
            );
            return $result;
        } else {
            return 'При получении информации о товаре возникла ошиибка';
        }
    }

    public static function add2basket($id = 0, $quantity = 1, $properties = [])
    {

        if ($quantity <= 0) {
            $quantity = 1;
        }
        $basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), \Bitrix\Main\Context::getCurrent()->getSite());
        if ($item = $basket->getExistsItem('catalog', $id)) {
            $item->setField('QUANTITY', $item->getQuantity() + $quantity);
        } else {
            $item = $basket->createItem('catalog', $id);
            $item->setFields(array(
                'QUANTITY' => $quantity,
                'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
                'LID' => \Bitrix\Main\Context::getCurrent()->getSite(),
                'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
            ));

        }
        $basket->save();
    }

    public static function updatebasket($id = 0, $quantity = 1)
    {
        $arFields = array(
            "QUANTITY" => intval($quantity),
        );
        $result = \CSaleBasket::Update(intval($id), $arFields);
        if ($result) {
            return $result;
        } else {
            return 'При обновлении товара возникла ошиибка';
        }
    }

    public static function delete($id = 0)
    {
        $result = \CSaleBasket::Delete(intval($id));
        return $result;
    }

    public static function clearBasket()
    {
        $result = \CSaleBasket::DeleteAll(\CSaleBasket::GetBasketUserID());
        return $result;
    }

    public static function getCountBasket()
    {
        return \CSaleBasket::GetList(false,
            array("FUSER_ID" => \CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"), false, false,
            array("ID"))->SelectedRowsCount();
    }

    public static function getAllPrice()
    {
        $return = 0;

        $dbBasketItems = \CSaleBasket::GetList(false, array(
            "FUSER_ID" => \CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL",
            "DELAY" => "N"
        ), false, false, array("ID", "QUANTITY", "PRICE"));
        while ($arItems = $dbBasketItems->Fetch()) {
            $return += $arItems['PRICE'] * $arItems['QUANTITY'];
        }

        return $return;
    }

    public static function getItemsInBasket($id)
    {
        CModule::IncludeModule('sale');
        $basket = Bitrix\Sale\Basket::loadItemsForFUser(Bitrix\Sale\Fuser::getId(),
            Bitrix\Main\Context::getCurrent()->getSite())->getOrderableItems();
        foreach ($basket as $basketItem) {
            $productId = $basketItem->getProductId();;
            $basketItems[$productId] = $productId;
        }
        if (in_array($id, $basketItems)) {
            return true;
        } else {
            return false;
        }
    }

    public static function setCoupon($coupon)
    {
        \Bitrix\Sale\DiscountCouponsManager::clear(true);
        \CCatalogDiscountCoupon::SetCoupon($coupon);
        return true;
    }
}