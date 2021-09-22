<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Application,
    Bitrix\Main\Loader,
    Bitrix\Main\Engine\ActionFilter\Authentication,
    Bitrix\Main\Engine\ActionFilter,
    Bitrix\Main\Engine\Contract\Controllerable,
    Bitrix\Main\Context,
    Bitrix\Main\Web\Cookie;

CJSCore::Init(array("fx", "ajax","jquery"));

class TwoQuickLoginComponent extends CBitrixComponent implements Controllerable
{
    private $componentPage = '';
    public function configureActions()
    {
        return [
            'auth' => [ // Ajax-метод
                'prefilters' => [],
            ],
        ];
    }

    public function authAction($data)
    {
        global $USER;
        $arAuthResult = $USER->Login($data['email'], $data['password'], 'N');
        if($arAuthResult === true){
            $result = ['STATUS' => 'SUCCESS'];
        }else{
            $result = ['STATUS' => 'ERROR','MESSAGE'=>$arAuthResult['MESSAGE']];
        }

        return $result;
    }
    public function Login() {
      $request = Context::getCurrent()->getRequest();
      $post = $request->getPostList()->toArray();

      if(!empty($post['email']) || !empty($post['password'])){
        if(strlen($post['email'])>0) {
          if(strlen($post['password'])>0) {
            $loginAct = $this->authAction($post);
            if($loginAct['STATUS']=='SUCCESS') {
              $this->arResult['OK_MESSAGE'] = 'ОК';
            } else {
              $this->arResult['ERRORS'] = $loginAct['MESSAGE'];
            }
          } else {
            $this->arResult['ERRORS'] = 'Вы не ввели пароль.';
          }
        } else {
          $this->arResult['ERRORS'] = 'Необходимо ввести имя пользователя.';
        }
      }
    }

    public function executeComponent()
    {
        $this->Login();
        $this->includeComponentTemplate($this->componentPage);
    }

}
