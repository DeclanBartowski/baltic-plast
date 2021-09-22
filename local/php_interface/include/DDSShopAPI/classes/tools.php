<?

namespace DDS;

use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Web\Uri;
use Bitrix\Main\SystemException;
use Bitrix\Main\UserTable;
use Bitrix\Main\Web\Json;

class Tools{

    private static $_cache = [];

    public static function getUserById($userId){
        if(!$userId) return false;

        $cacheID = __METHOD__.$userId;
        if(!empty(self::$_cache[$cacheID])){
            return self::$_cache[$cacheID];
        }

        $rsUser = \CUser::GetByID($userId);
        $arUser = $rsUser->Fetch();

        self::$_cache[$cacheID] = $arUser;

        return self::$_cache[$cacheID];
    }

    public static function getHLEntityDataClass($HlBlockId){

        $cacheID = __METHOD__.$HlBlockId;
        if(!empty(self::$_cache[$cacheID])){
            return self::$_cache[$cacheID];
        }

        if(!\CModule::IncludeModule('highloadblock')) return false;
        if (!$HlBlockId){
            return false;
        }

        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($HlBlockId)->fetch();
        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();

        self::$_cache[$cacheID] = $entity_data_class;

        return $entity_data_class;
    }

    public static function getIBlockIdByElemID($elementId){
        if(!$elementId) return false;
        if(!\Bitrix\Main\Loader::includeModule('iblock')) return false;

        $arSort     = [];
        $arSelect   = ["ID", "IBLOCK_ID"];
        $arFilter   = ["ID" => $elementId];
        $res        = \CIBlockElement::GetList($arSort, $arFilter, false, ['nTopCount' => 1], $arSelect);

        if($arItem = $res->GetNext()){
            return $arItem['IBLOCK_ID'];
        }

        return false;

    }

    public static function getActiveElemsListCached($IBLOCK_ID, $arSort = ['SORT' => 'ASC'])
    {
        if(!$IBLOCK_ID) return false;

        if(!\Bitrix\Main\Loader::includeModule('iblock')) return false;

        $cache_id = md5(__CLASS__.'/'.__FUNCTION__.$IBLOCK_ID.serialize($arSort));
        $cache_dir = "/".__CLASS__.'/'.__FUNCTION__;
        $ttl = 3600000;

        $obCache = \Bitrix\Main\Data\Cache::createInstance();

        if(
            (defined('BX_COMP_MANAGED_CACHE') && BX_COMP_MANAGED_CACHE === true) && // managet cache is on
            $obCache->initCache($ttl, $cache_id, $cache_dir)
        ){
            $arResult = $obCache->getVars();
        } elseif($obCache->startDataCache()){

            $cacheManager = \Bitrix\Main\Application::getInstance()->getTaggedCache();

            $arSelect   = ["*"];
            $arFilter   = ["IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y"];
            $res        = \CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

            while($obItem = $res->GetNextElement()){
                $arItem = $obItem->GetFields();
                $arItem['PROPS'] = $obItem->GetProperties();

                $arResult[$arItem['ID']] = $arItem;
            }

            $cacheManager->registerTag("iblock_id_".$IBLOCK_ID);
            $cacheManager->endTagCache();

            $obCache->endDataCache($arResult);
        }

        return $arResult;

    }

    public static function getElemByIdCached($ELEMENT_ID, $IBLOCK_ID)
    {
        if(!$ELEMENT_ID) return false;
        if(!$IBLOCK_ID) return false;

        if(!\Bitrix\Main\Loader::includeModule('iblock')) return false;

        $cache_id = md5(__CLASS__.'/'.__FUNCTION__.$ELEMENT_ID.$IBLOCK_ID);
        $cache_dir = "/".__CLASS__.'/'.__FUNCTION__;
        $ttl = 3600000;

        $obCache = \Bitrix\Main\Data\Cache::createInstance();

        if(
            (defined('BX_COMP_MANAGED_CACHE') && BX_COMP_MANAGED_CACHE === true) && // managet cache is on
            $obCache->initCache($ttl, $cache_id, $cache_dir)
        ){
            $arResult = $obCache->getVars();
        } elseif($obCache->startDataCache()){

            $cacheManager = \Bitrix\Main\Application::getInstance()->getTaggedCache();

            $arSort     = [];
            $arSelect   = ["*"];
            $arFilter   = ["IBLOCK_ID"=>$IBLOCK_ID, "ID"=>$ELEMENT_ID];
            $res        = \CIBlockElement::GetList($arSort, $arFilter, false, ['nTopCount' => 1], $arSelect);

            if($obItem = $res->GetNextElement()){
                $arItem = $obItem->GetFields();
                $arItem['PROPS'] = $obItem->GetProperties();

                $arResult = $arItem;
            }

            $cacheManager->registerTag("iblock_id_".$IBLOCK_ID);
            $cacheManager->endTagCache();

            $obCache->endDataCache($arResult);
        }

        return $arResult;

    }

    public static function isUserPassword($password,$userId){

        $rsUser = \CUser::GetByID($userId);
        $userData = $rsUser->Fetch();
        $salt = substr($userData['PASSWORD'], 0, (strlen($userData['PASSWORD']) - 32));
        $realPassword = substr($userData['PASSWORD'], -32);
        $password = md5($salt.$password);
        return ($password == $realPassword);

    }

    public static function savePasswordCheckOld($oldPassword,$newPassword,$newPasswordConfirm,$userId){

        if(self::isUserPassword($oldPassword,$userId)){
            if($newPassword==$newPasswordConfirm){
                global $USER;
                $UserId = $USER->GetID();
                $user = new \CUser;
                $arFields = Array(
                    "PASSWORD" => $newPassword,
                    "CONFIRM_PASSWORD" => $newPasswordConfirm,
                );
                $ID = $user->Update($UserId, $arFields);
                if (intval($ID) > 0){
                    return ['MESSAGE'=>'Пароль успешно обнавлен','STATUS'=>'SUCCSESS'];

                }
                else{
                    return ['MESSAGE'=>$user->LAST_ERROR,'STATUS'=>'ERROR'];

                }
            }
            else{
                return ['MESSAGE'=>'Новый пароль повторён некоректно','STATUS'=>'ERROR'];
            }
        }
        else{
            return ['MESSAGE'=>'Не верный старый пароль','STATUS'=>'ERROR'];
        }

    }

    public static function userUpdate($userID,$date){

        $user = new \CUser;
        $ID = $user->Update($userID, $date);
        if (intval($ID) > 0){
            return "Информация о пользователе успешно обновлена";
        }
        else{
            throw new SystemException($user->LAST_ERROR);
        }
    }

    public static function userRegister($data){
            global $USER;
            $user = new \CUser;
            $ID = $user->Add($data);
            if (intval($ID) > 0){
                    $USER->Authorize($ID);
                return ['STATUS' => 'SUCCESS', 'MESSAGE' => 'Регистрация завершена'];
            }
            else
                return ['STATUS' => 'ERROR', 'MESSAGE' => $user->LAST_ERROR];
    }

    public static function savePassword($newPassword,$newPasswordConfirm){
        if($newPassword==$newPasswordConfirm){
            global $USER;
            $UserId = $USER->GetID();
            $user = new \CUser;
            $arFields = Array(
                "PASSWORD" => $newPassword,
                "CONFIRM_PASSWORD" => $newPasswordConfirm,
            );
            $ID = $user->Update($UserId, $arFields);
            if (intval($ID) > 0){
                return "Пароль успешно обнавлен";
            }
            else{
                throw new SystemException($user->LAST_ERROR);
            }
        }
        else{
            throw new SystemException('Новый пароль повторён некоректно');
        }
    }

    public static function getUrl() {
        $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
        $url .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
        $url .= $_SERVER["REQUEST_URI"];
        return $url;
    }

    public static function declOfNum($number, $titles)
    {
        $cases = array (2, 0, 1, 1, 1, 2);
        return $number." ".$titles[ ($number%100>4 && $number%100<20)? 2 : $cases[min($number%10, 5)] ];
    }

    public static function dump($var)
    {
        global $USER;
        if ($USER->IsAdmin()) {
            echo "<pre>";
            var_dump($var);
            echo "</pre>";
        }
    }

    public static function extractBase64Zip(&$input)
    {
        $zipFileContents = base64_decode($input);

        $zipPath = $_SERVER['DOCUMENT_ROOT'].'/upload/zips';
        file_put_contents($zipPath.'/xmlregions.zip', $zipFileContents);

        $zip = new \ZipArchive;
        if ($zip->open($zipPath.'/xmlregions.zip') === true) {

            if ($zip->extractTo($zipPath)) {
                $xmlRegions = file_get_contents($zipPath.'/regions.xml');

                $files = array_diff(scandir($zipPath), ['.', '..']);
                foreach ($files as $file) {
                    unlink("$zipPath/$file");
                }

            } else {

            }

            $zip->close();

        } else {

        }

        return $xmlRegions;

    }

    public static function validateDate($date, $format = 'd.m.Y H:i:s')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    public static function getDiscount($price, $quantity = 1){
        CModule::IncludeModule("currency");
        $old = CCurrencyLang::CurrencyFormat( $price,"RUB" );
        $discount = false;
        global $USER;
        if (!$USER->IsAuthorized()) {
            if($quantity > 4 && $quantity < 10 ) {
                $currentPrice = $price * 3 / 100;
                $price = $price - round($currentPrice);
                $discount = 3;
            } else if($quantity > 9 && $quantity < 15) {
                $currentPrice = $price * 5 / 100;
                $price = $price - round($currentPrice);
                $discount = 5;
            } else if($quantity > 14) {
                $currentPrice = $price * 7 / 100;
                $price = $price - round($currentPrice);
                $discount = 7;
            }
        }
        $one = CCurrencyLang::CurrencyFormat( $price,"RUB" );
        $price = $price * $quantity;
        $price = CCurrencyLang::CurrencyFormat( $price,"RUB" );
        return ['PRICE' => $price, 'DISCOUNT' => $discount, 'ONEPRICE' => $one, 'OLD' => $old];
    }

    public static  function Getcountries()
    {
        if(!\Bitrix\Main\Loader::includeModule('iblock')) return false;

        $res = \CIBlockElement::GetList(false, array('IBLOCK_ID'=>14), false, false, array('ID','NAME','CODE','PREVIEW_PICTURE'));
        while($ob = $res->GetNextElement()){
            $arFields = $ob->GetFields();
            $arFields['PREVIEW_PICTURE'] = \CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
            $arFields['PROPERTIES'] = $ob->GetProperties();
                $elements[$arFields['ID']] = $arFields;
        }

        return $elements;
    }
    public static function compfav($request)
    {
        $id = $request->getPost('id');
        $add = $request->getPost('add');
        $_SESSION[$add][$id] = $id;

        return true;
    }
    public static function compfavdelete($request)
    {
        $id = $request->getPost('id');
        $add = $request->getPost('add');
        unset($_SESSION[$add][$id]);

        return true;
    }

}