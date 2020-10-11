<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 27/1/18
 * Time: 11:41 AM
 */

namespace frontend\components;


use backend\modules\user\models\User;
use yii\base\Widget;

class ProfileApprovalWarning extends Widget
{
    public function run()
    {
        if(\Yii::$app->user->isGuest) return false;

        /** @var $user User*/
        $user = \Yii::$app->user->identity;
        if($user->isProfileApproved()) return false;
        return 'Profile is under review or rejected';
    }
}