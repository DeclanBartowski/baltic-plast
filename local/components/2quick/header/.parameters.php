<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "PHONE" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage('TQ_CONTACTS_PARAMS_PHONE'),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ),
        "EMAIL" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage('TQ_CONTACTS_PARAMS_EMAIL'),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ),
        "PATH_TO_PERSONAL" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage('TQ_CONTACTS_PARAMS_PATH_TO_PERSONAL'),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ),
        "INST" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage('TQ_CONTACTS_PARAMS_INST'),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ),
        "VK" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage('TQ_CONTACTS_PARAMS_VK'),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ),
        "YOUTUBE" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage('TQ_CONTACTS_PARAMS_YT'),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ),
        "FACEBOOK" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage('TQ_CONTACTS_PARAMS_FB'),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ),

    ),
);
?>
