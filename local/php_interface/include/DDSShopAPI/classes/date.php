<?

namespace DDS;

use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Web\Uri;
use Bitrix\Main\SystemException;
use Bitrix\Main\UserTable;
use Bitrix\Main\Web\Json;

class Date{

    public static function declension($digit,$expr,$onlyword=false){
        if(!is_array($expr)) $expr = array_filter(explode(' ', $expr));
        if(empty($expr[2])) $expr[2]=$expr[1];
        $i=preg_replace('/[^0-9]+/s','',$digit)%100;
        if($onlyword) $digit='';
        if($i>=5 && $i<=20) $res=$digit.' '.$expr[2];
        else
        {
            $i%=10;
            if($i==1) $res=$digit.' '.$expr[0];
            elseif($i>=2 && $i<=4) $res=$digit.' '.$expr[1];
            else $res=$digit.' '.$expr[2];
        }
        return trim($res);
    }

    public static function downCounter($date){
        $check_time = strtotime($date) - time();
        if($check_time <= 0){
            return false;
        }

        $days = floor($check_time/86400);
        $hours = floor(($check_time%86400)/3600);
        $minutes = floor(($check_time%3600)/60);
        $seconds = $check_time%60;

        $str = '';
        if($days > 0) $str .= self::declension($days,array('день','дня','дней')).' ';
        if($hours > 0) $str .= self::declension($hours,array('час','часа','часов')).' ';
        if($minutes > 0) $str .= self::declension($minutes,array('минута','минуты','минут')).' ';
        if($seconds > 0) $str .= self::declension($seconds,array('секунда','секунды','секунд'));

        return $str;
    }


}