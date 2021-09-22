<?php
if(!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arComponentDescription = [
    'NAME' => Loc::getMessage('PROJECT_NAME_REG'),
    'DESCRIPTION' => Loc::getMessage('PROJECT_NAME_DESCRIPTION_REG'),
    'SORT' => 10,
    "COMPLEX" => "Y",
    'PATH' => [
        'ID' => 'project',
        'NAME' => Loc::getMessage('PROJECT_FORGOT_REG'),
        'SORT' => 10,
    ]
];