<?php
require_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

//use Dotenv\Dotenv;
//
//
//try {
//    $dotenv = Dotenv::createImmutable(dirname(__DIR__, 1));
//    $dotenv->load();
//} catch (Exception $e) {
//    printf("Ошибка при подключении окружения: %s в файле %s(%d)", $e->getMessage(), $e->getFile(), $e->getLine());
//    exit(1);
//}
//
//define('PROJECT_DIR', dirname(__DIR__));
//
//define('API_DOMAIN', $_ENV['API_DOMAIN']);