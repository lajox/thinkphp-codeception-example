<?php

defined('ROOT_PATH') or define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
defined('APP_PATH') or define('APP_PATH', ROOT_PATH . 'application' . DIRECTORY_SEPARATOR);
defined('ADDON_PATH') or define('ADDON_PATH', ROOT_PATH . 'addons' . DIRECTORY_SEPARATOR);

// 加载基础文件
require_once ROOT_PATH . '/thinkphp/base.php';

// 应用初始化
//\think\App::getInstance()->path(ROOT_PATH . 'application/')->initialize();
\think\Container::get('app')->path(ROOT_PATH . 'application/')->initialize();
