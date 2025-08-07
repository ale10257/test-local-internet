Развертываем проект
------

`git clone git@github.com:ale10257/test-local-internet.git .`

В папке с проектом `docker-compose up -d` 

Переходим в контейнер php
`docker-compose exec php bash` 

Последовательно выполняем команды:  
`php init`(выбираем локальное окружение) `php init` `composer install`  `./yii migrate`

Данные для подключения к БД берем из файла .env в корне проекта

В файл hosts добавляем домены `127.0.0.1  front.loc bg.loc api.loc`

Проверяем работу приложения согласно ТЗ

