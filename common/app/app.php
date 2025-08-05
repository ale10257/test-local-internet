<?php

require dirname(__DIR__, 2) . '/vendor/autoload.php';
// загружаем переменные окружения
$dirEnv = dirname(__DIR__, 2) . '/env';
$files = [
    'common' => '.env-common',
    'backend' => '.env-backend',
    'frontend' => '.env-frontend',
    'console' => '.env-console',
    'api' => '.env-api',
];
$envFiles = [$files['common'], $files[ENV_APP]];
$repository = Dotenv\Repository\RepositoryBuilder::createWithNoAdapters()
    ->addAdapter(Dotenv\Repository\Adapter\EnvConstAdapter::class)
    ->addWriter(Dotenv\Repository\Adapter\PutenvAdapter::class)
    ->make();
$dotenv = Dotenv\Dotenv::create($repository, $dirEnv, $envFiles, false);
$dotenv->load();

define('YII_ENV', $_ENV['YII_ENV']);
if (YII_ENV == 'dev') {
    define('YII_DEBUG', true);
} else {
    define('YII_DEBUG', false);
}
