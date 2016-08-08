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
```

Web assets
```
php bin/console assets:install
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