Для того, чтобы развернуть данный проект у себя на локальной машине необходимо:
1) В командной строке выполнить ряд команд
 a)composer install;
 b)php init (выбираем [0]Development и "yes");
2) Настраиваем базу данных:
 a)создаём бд "yii2-cms";
 b)изменяем подключение к базе дыннх в конфигах(common/config/main-colal) на 'dsn' => 'mysql:host=localhost;dbname=yii2-cms';
3) Пишем в консоли yii migrate.

Настройки сервера:
Nginx-1.10
PHP 7.0 x64
MySQL 5.7 x64