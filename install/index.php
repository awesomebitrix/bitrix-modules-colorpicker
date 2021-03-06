<?php

class colorpicker extends CModule {
 
    const MODULE_ID = "colorpicker";
    var $MODULE_ID = "colorpicker";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_GROUP_RIGHTS;
    var $errors = array();

    function __construct() {
        $arModuleVersion = array(); 
        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path . "/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }

        $this->MODULE_NAME = 'colorpicker';
        $this->MODULE_DESCRIPTION = 'Добавляет новое свойство для инфоблока позволяющее выбрать цвет'; 
    }

    function DoInstall() {
        CopyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . self::MODULE_ID . '/install/public_html/', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/', true, true);
        RegisterModuleDependences('iblock', 'OnIBlockPropertyBuildList', self::MODULE_ID, 'UserDataColor', 'GetIBlockPropertyDescription');
//      RegisterModuleDependences('main', 'OnUserTypeBuildList', self::MODULE_ID, 'UserDataColor', 'GetUserTypeDescription');
        RegisterModule(self::MODULE_ID);
    }

    function DoUninstall() {
        DeleteDirFilesEx('/bitrix/js/' . self::MODULE_ID);
        DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/" . self::MODULE_ID . "/install/public_html/themes/.default/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default");
        UnRegisterModuleDependences('iblock', 'OnIBlockPropertyBuildList', self::MODULE_ID, 'UserDataColor', 'GetIBlockPropertyDescription');
//      UnRegisterModuleDependences('main', 'OnUserTypeBuildList', self::MODULE_ID, 'UserDataColor', 'GetUserTypeDescription');
        UnRegisterModule(self::MODULE_ID);
    }

}

 
