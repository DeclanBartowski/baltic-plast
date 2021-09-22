<?php
if(!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arComponentDescription = [
    'NAME' => Loc::getMessage('PROJECT_NAME_FORGOT'),
    'DESCRIPTION' => Loc::getMessage('PROJECT_NAME_DESCRIPTION_FORGOT'),
    'SORT' => 10,
    "COMPLEX" => "Y",
    'PATH' => [
        'ID' => 'project',
        'NAME' => Loc::getMessage('PROJECT_FORGOT'),
        'SORT' => 10,
    ]
];