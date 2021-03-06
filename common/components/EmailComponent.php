<?php
namespace common\components;
use yii\base\Component;
use Yii;
use common\models\InfoSite;

class EmailComponent extends Component{

    public $infoSite;

    public function init(){
        parent::init();
        $this->infoSite = InfoSite::find()->select(['title', 'letter_email', 'letter_phone'])->where(['id' => 1])->one();
    }

    /**
     * тестовая отправка сообщения
     */
    public function test($userTo){
        Yii::$app->mailer->compose(['html' => 'test'], ['model' => $this->infoSite])
            ->setFrom($this->infoSite->letter_email)
            ->setTo($userTo)
            ->setSubject('Тестовое письмо')
            ->setTextBody('текст тестового письма')
            ->send();
    }

    /**
     * регистрация
     */
    public function regUser($userTo, $contentMas){
        Yii::$app->mailer->compose(['html' => 'regUser'], ['contentMas' => $contentMas])
            ->setFrom($this->infoSite->letter_email)
            ->setTo($userTo)
            ->setSubject('Вы успешно зарегистрировались на ' . $this->infoSite->title)
            ->send();
    }

    /**
     * подстверждения email
     */
    public function checkEmailUser($userTo, $contentMas){
        Yii::$app->mailer->compose(['html' => 'checkEmailUser'], ['contentMas' => $contentMas])
           ->setFrom($this->infoSite->letter_email)
            ->setTo($userTo)
            ->setSubject('Подтвердите адрес электроннно почты')
            ->send();
    }

    /**
     * Восстановление пароля
     */
    public function passwordResetToken($userTo, $user){
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom($this->infoSite->letter_email)
            ->setTo($userTo)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }

}