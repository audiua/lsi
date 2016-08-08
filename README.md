lsi.loc
=======

Setup
--------------
Install dependencies
```sh
git clone https://github.com/audiua/lsi.git .
composer install
bower install
```

Add to your my.ini
```ini
[mysqld]
collation-server     = utf8mb4_general_ci # Replaces utf8_general_ci
character-set-server = utf8mb4            # Replaces utf8
```

Create the database
```sh
php bin/console doctrine:database:create
```

Update database schema
```
php bin/console doctrine:schema:update --force
Дамп данных - var/dump_sql/* ()
```

Web assets
```
php bin/console assets:install
php bin/console assetic:dump
```

Performance issues?
--------------
Use php7 (5.5+ highly recommended), disable xdebug and set this variable in your php.ini.
```ini
realpath_cache_size = 2M
xdebug.profiler_enable = 0
xdebug.remote_enable = 0
```

Make sure you use /app_dev.php/ in your dev environment to prevent caching.


Run application
```
php bin/console server:run
```

http:127.0.0.1:8000/shop - shops lish
http:127.0.0.1:8000/shop/new - add shop
http:127.0.0.1:8000/cron-manager - crontab ui


Основная комманда крона `php bin/console app:cron` которая запускает асинхронно
парсера для всех магазинов, которые нужно парсить(исходя из настроек
магазина - repeatTime в секундах).

php bin/console app:cron -  все магазины
php bin/console app:parser id -  парсинг магазина с id

===========
По таблицам:

    - FieldMap: Таблица связывания полей с апи магазинов с полями таблицы нужных данных.
Поля в таблице могут иметь дефолтное значения, что позволяет задавать дефолтные данные
магазина, которых нет в его апи. Если указано дефолтное значения поля, оно в парсинге не участвует.

    - ShopConditions: Таблица условий для магазина, позволяет задавать условия для полей парсинга.

    - Result: таблица с получеными данными.

    - Shop: таблица настроек магазина. Урл апи, время повторения в секундах.

    - Cron: таблица для логирования время выполнения парсинга магазинов.

=========
