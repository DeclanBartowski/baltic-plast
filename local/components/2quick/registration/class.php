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
    Bitrix\Main\Mail\Event,
    Bitrix\Main\Security\Random;

CJSCore::Init(array("fx", "ajax", "jquery"));

class TwoQuickRegistrationComponent extends \CBitrixComponent implements Controllerable
{
    private $componentPage = '';

    public function configureActions()
    {
        return [
            'register' => [ // Ajax-метод
                'prefilters' => [],
            ],
        ];
    }

    public function registerAction()
    {
        global $USER;
        $request = Context::getCurrent()->getRequest();
        $post = $request->getPostList()->toArray();
        $email = $post['email'];
        $password = randString(7, array(
            "abcdefghijklnmopqrstuvwxyz",
            "ABCDEFGHIJKLNMOPQRSTUVWXYZ",
            "0123456789",
            "!@#\$%^&*()",
        ));
        $password_confirm = $password;
        $arRegisterResult = $USER->Register($email, '', '', $password, $password_confirm, $email);
        if ($arRegisterResult['TYPE'] == 'OK') {
            if ($post['UF_MARKETING']) {
                $user = new CUser;
                $fields = array(
                    'UF_MARKETING' => $post['UF_MARKETING']
                );
                $user->Update($USER->GetID(), $fields);
            }
            Event::send(array(
                "EVENT_NAME" => "USER_REGISTER",
                "LID" => SITE_ID,
                "C_FIELDS" => array(
                    "EMAIL" => $email,
                    "LOGIN" => $email,
                    "PASSWORD" => $password,
                ),
            ));
            $result = [
                'STATUS' => 'SUCCESS',
                'MESSAGE' => GetMessage('TQ_REGISTRATION_SUCCESS')
            ];
            $this->arResult['OK_MESSAGE'] = $arRegisterResult['MESSAGE'];
        } else {
            $result = ['STATUS' => 'ERROR', 'MESSAGE' => $arRegisterResult['MESSAGE']];
            $this->arResult['ERRORS'] = $arRegisterResult['MESSAGE'];
        }
        return $result;
    }

    public function executeComponent()
    {
        $this->includeComponentTemplate($this->componentPage);
    }

}
