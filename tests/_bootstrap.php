<?php
# _bootstrap.php 文件

function _autoloader($dir)
{
    spl_autoload_register(function ($class) use ($dir) {
        if (class_exists($class)) {
            return true;
        }

        $pathPsr4 = $dir."/".strtr($class, '\\', DIRECTORY_SEPARATOR) . ".php";
        if (file_exists($pathPsr4)){
            require_once $pathPsr4;
        }

        return true;

    });
}
define('BOOT_ROOT', dirname(__DIR__));
_autoloader(BOOT_ROOT);

// 下面这段，是触发tp框架初始化用的...这样就可以调用Model等信息了
require_once __DIR__ . '/../public/cli.php';
