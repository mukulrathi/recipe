<?php
/**
 * Created by PhpStorm.
 * User: Mongo
 * Date: 14-Jul-16
 * Time: 6:21 PM
 */

namespace common\models;

use Yii;
use yii\base\Model;

class ChangePasswordForm extends Model
{
    public $old_password;
    public $new_password;
    public $new_password_repeat;

    public function rules()
    {
        return [
            [['old_password', 'new_password', 'new_password_repeat'], 'required'],
            ['old_password','checkOldPassword'],
            ['new_password', 'match', 'pattern' => '/((?=.*[\d])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,})/', 'message' => 'New password must match the pattern eg. ex@Mp1e'],
            ['new_password_repeat','compare','compareAttribute'=>'new_password'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'old_password'=>'Old Password',
            'new_password'=>'New Password',
            'new_password_repeat'=>'Repeat New Password',
        ];
    }

    public function checkOldPassword($attribute, $params)
    {
        $logged_in_user_id = Yii::$app->user->identity->getId();
        $user = User::findIdentity($logged_in_user_id);
        
        if(!$user->validatePassword($this->old_password))
            $this->addError($attribute,'Old password is incorrect');
    }
}