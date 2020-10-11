<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_notification".
 *
 * @property int $user_id
 * @property int $text_notification
 * @property int $email_notification
 *
 * @property User $user
 */
class UserNotification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text_notification', 'email_notification'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'text_notification' => Yii::t('app', 'Text Notification'),
            'email_notification' => Yii::t('app', 'Email Notification'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
