<?php

// Database Constants
defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
defined('DB_NAME') ? null : define("DB_NAME", "project_vanilla");
defined('DB_USER') ? null : define("DB_USER", "pro-man");
defined('DB_PASS') ? null : define("DB_PASS", "devWel189");

// Web site constants
defined('DS') ? null : define('DS', '/');
defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT']);
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT . DS . 'includes');
