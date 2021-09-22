<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}


$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "TITLE" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage('TQ_CONTACTS_PARAMS_TITLE'),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ),
        "SUBTITLE" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage('TQ_CONTACTS_PARAMS_SUB_TITLE'),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ),
        "PHONES" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage('TQ_CONTACTS_PARAMS_PHONES'),
            "TYPE" => "STRING",
            "DEFAULT" => "",
            "MULTIPLE" => 'Y'
        ),
        "ADDRESSES" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage('TQ_CONTACTS_PARAMS_ADDRESS'),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ),
        "EMAIL" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage('TQ_CONTACTS_PARAMS_EMAIL'),
            "TYPE" => "STRING",
            "DEFAULT" => "",
            "MULTIPLE" => 'Y'
        ),
        "EMAIL_DESCRIPTION" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage('TQ_CONTACTS_PARAMS_EMAIL_DESCRIPTIONS'),
            "TYPE" => "STRING",
            "DEFAULT" => "",
            "MULTIPLE" => 'Y'
        ),
        "MAP_COORDS" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage('TQ_CONTACTS_PARAMS_MAP_COORDINATES'),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ),
        "MAP_BALLOONS" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage('TQ_CONTACTS_PARAMS_MAP_BALLOONS'),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        )
    ),
);

?>
