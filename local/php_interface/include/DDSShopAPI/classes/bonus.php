<?php
/**
 * Created by PhpStorm.
 * User: pavel.sidorenko
 * Date: 18.09.2018
 * Time: 13:40
 */

namespace DDS\Tools;

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Loader;
use Bitrix\Sale;



/**
 * Class Bonus
 * @package DDS\Tools
 */
class Bonus
{

    private $hb_block = 1;
    private $entity;
    private $percent = 3;

    /**
     * Bonus constructor.
     */
    public function __construct()
    {
        Loader::includeModule("highloadblock");
        $hlblock = HL\HighloadBlockTable::getById($this->hb_block)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $this->entity = $entity->getDataClass();
    }

    /**
     * Обновление бонусов для пользователя
     * @param array $order_info;
     * @return void
     */
    public function updateBonus($order_info){
        $date='01.'.date('m').'.'.date('y');
        $bonus = $this->getBonusByFilter(array(">=UF_DATE"=>MakeTimeStamp($date),'=UF_USER_ID'=>$order_info['USER_ID']));
        $bonus_summ=0;
        foreach ($bonus as $bonus_one){
            $bonus_summ+=$bonus_one['UF_QUANTITY'];
        }
        $user_update= new \CUser;
        $user_update->Update($order_info['USER_ID'], array('UF_POKUPKI'=>$bonus_summ));

    }


	/**
	 * Добавления бонусов
     * @param array $params;
     * @return array
	 */
    public function addBonus($params){
    	$result_add = false;
        $entity = $this->entity;
        if(!$this->getBonusByFilter(array('UF_ID'=> $params['UF_ID']))){
			$result = $this->getOrder($params['UF_ID']);
			$params = array(
				"UF_DATE" => time(),
				"UF_TYPE" => 1,
				"UF_USER_ID" => (int)$result['USER_ID'],
				"UF_ID" => (int)$params['UF_ID'],
				"UF_QUANTITY" => (float)$result['PRICE'],
			);
			$result_add = $entity::add($params);
			$this->updateBonus($result);
		}
        return $result_add;
	}


	/**
	 * Получение информации по заказу
	 * @param int $id;
	 * @return array
	 */
	public function getOrder($id){
		Loader::includeModule("sale");
		$order = Sale\Order::load($id);
		if(!empty($order)){
            $result['PRICE'] =  $order->getPrice();
            $result['USER_ID'] =  $order->getUserId();
            return $result;
        }
		return [];
	}


    /**
     * Получение бонусов по фильтру
     * @param array $filter;
     * @return array
     */
    public function getBonusByFilter($filter = array()){
        $entity =$this->entity;
        $result = $entity::getList(['filter' => $filter])->fetchAll();
        if(empty($result)){
            $result=false;
        }
            return $result;
    }

}