<?php
namespace frontend\widget;
use yii\base\Widget;

class MenuSettingsPanel extends Widget{

    public function run()
    {
        return $this->render('menu-settings');
    }

}