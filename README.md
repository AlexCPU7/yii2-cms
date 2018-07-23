Установка:
-------------
- composer install
- php init 
- создаём и подключаемся к бд (изменяем подключение к базе дыннх в конфигах(common/config/main-colal) на 'dsn' => 'mysql:host=localhost;dbname=yii2-cms')
- yii migrate 
- yii migrate --migrationPath=@yii/rbac/migrations
- yii start
- создать папку: ./frontend/web/uploads/users