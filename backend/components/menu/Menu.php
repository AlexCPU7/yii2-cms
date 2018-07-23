<?php
namespace backend\components\menu;
use Yii;
use yii\helpers\Url;
/**
 * Created by PhpStorm.
 * User: Dev
 * Date: 23.03.2018
 * Time: 16:20
 */

class Menu {

    /* Настройки сайта */
    function menuSettingsSite(){
        $permissions = [
            'admin_menu_rbac_roles',
            'admin_menu_rbac_permission',
            'admin_menu_rbac_users',
            'info_site',
            'settings_add_email_push'
        ];

        foreach ($permissions as $permission) {
            if (Yii::$app->user->can($permission)) {
                return true;
            }
        }

        return false;
    }

    /* Пользователи */
    function menuUsers(){
        $permissions = [
            'users_clients',
        ];

        foreach ($permissions as $permission) {
            if (Yii::$app->user->can($permission)) {
                return true;
            }
        }

        return false;
    }

    /* Магазин */
    function menuShop(){
        $permissions = [
            'can_module_shop_category',
            'can_module_shop_options',
            'can_module_shop_item',
        ];

        foreach ($permissions as $permission) {
            if (Yii::$app->user->can($permission)) {
                return true;
            }
        }

        return false;
    }
}