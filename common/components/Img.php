<?php
namespace common\components;
use Yii;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\helpers\FileHelper;

class Img
{
    public function Save($model, $path = '/uploads/', $attribute){

        /* перед загрузкой удалить изображение(доделать) */
        $dir = $path . $model->id . '/';
        $fullDir = Yii::getAlias('@frontend') . '/web/' . $dir;

        if (!is_dir($fullDir)){
            FileHelper::createDirectory($fullDir);
        }

        $file = UploadedFile::getInstance($model, $attribute);

        if (is_null($file)){
            return false;
        }

        $imgName = strtotime('now') . '_' . Yii::$app->security->generateRandomString(8). '.' . $file->getExtension();
        $fullName = $fullDir . $imgName;
        $model->img = $dir . $imgName;

        if ($model->validate()){
            if($file->saveAs($fullName)){
                $model->save();
            }
        }
    }
}