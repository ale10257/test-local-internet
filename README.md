Развертываем проект
------

`git clone git@github.com:ale10257/test-local-internet.git .`

В папке с проектом `./init.sh` `docker-compose up -d` 

Переходим в контейнер php
`docker-compose exec php bash` 

Последовательно выполняем команды:  
`php init`(выбираем локальное окружение) `composer install`  `./yii migrate`

В файл hosts добавляем домены `127.0.0.1  front.loc bg.loc api.loc`

Проверяем работу приложения согласно ТЗ

