<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 27/1/18
 * Time: 11:32 AM
 */

namespace frontend\components;


use backend\modules\user\models\User;
use yii\base\Widget;
use yii\helpers\Url;

class EmailVerificationWarning extends Widget
{
    public function run()
    {
        if(\Yii::$app->user->isGuest) return false;

        /** @var $user User*/
        $user = \Yii::$app->user->identity;
        if($user->isEmailVerified()) return false;
        return '<div class="alert alert-danger" role="alert"> <strong>Oh snap!</strong> It seems that you\'re email isn\'t verified. If you didn\'t receive a verification email, you can request a new verification <a href="' . Url::to(['/site/resend-verification-token'], true) . '">link</a>. </div>';
    }
}