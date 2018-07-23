<?php
namespace console\controllers;
use common\models\InfoSite;
use yii\console\Controller;
use Yii;
use common\models\User;
class StartController extends Controller
{
    public function actionIndex() {

        /**
         * Создаём пользователя
         */
        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin';
        $user->first_name = 'Админ';
        $user->last_name = 'Админский';
        $user->middle_name = 'Админович';
        $user->phone = '+7(800)555-35-35';

        $user->setPassword('admin');
        $user->generateAuthKey();
        $user->save();

        /**
         * Создаём инфо сайта
         */
        $infoSite = new InfoSite();
        $infoSite->title = 'My Site';
        $infoSite->letter_email = 'test.test.37@yandex.ru';
        $infoSite->letter_email_pass = 'testtesttest';
        $infoSite->save();

        /**
         * Создаём роли
         */
        $arrRoles = [
            ['name' => 'admin',   'descr' => 'Администратор'],
            ['name' => 'manager', 'descr' => 'Контент менеджер'],
            ['name' => 'user',    'descr' => 'Пользователь'],
            ['name' => 'ban',     'descr' => 'Заблокирован'],
        ];

        foreach ($arrRoles as $item){
            $role = Yii::$app->authManager->createRole($item['name']);
            $role->description = $item['descr'];
            Yii::$app->authManager->add($role);
        }

        /**
         * Создаём права(доступ)
         * Наследования ролей и прав
         */
        $arrPermissions = [
            ['name' => 'canAdmin',                   'descr' => 'Доступ в админку'],
            ['name' => 'info_site',                  'descr' => 'Общая информация'],
            ['name' => 'widgetAdminPanel',           'descr' => 'Виджет админ панели'],
            ['name' => 'admin_menu_rbac_users',      'descr' => 'Доступ к меню "Пользователи"'],
            ['name' => 'admin_menu_rbac_permission', 'descr' => 'Доступ к меню "Расшифровка доступов"'],
            ['name' => 'admin_menu_rbac_roles',      'descr' => 'Доступ к меню "Роли пользователей"'],
            ['name' => 'settings_add_email_push',    'descr' => 'Почтовые уведомления'],
            ['name' => 'can_some_tools',             'descr' => 'Some tools'],
            ['name' => 'users_clients',              'descr' => 'Пользователи']
        ];

        $role_adm = Yii::$app->authManager->getRole('admin');
        foreach ($arrPermissions as $item){
            $permission = Yii::$app->authManager->createPermission($item['name']);
            $permission->description = $item['descr'];
            Yii::$app->authManager->add($permission);
            $perm = Yii::$app->authManager->getPermission($item['name']);
            Yii::$app->authManager->addChild($role_adm, $perm);
        }

        /**
         * Назначение роли пользователю
         */
        $user_role = Yii::$app->authManager->getRole('admin');
        Yii::$app->authManager->assign($user_role, 1);
    }
}