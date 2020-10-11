<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_verification".
 *
 * @property int $user_id
 * @property string $token
 * @property string $request_time
 * @property int $responded
 *
 * @property User $user
 */
class UserVerification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_verification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token', 'request_time'], 'required'],
            [['request_time'], 'safe'],
            [['responded'], 'integer'],
            [['token'], 'string', 'max' => 255],
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
            'token' => Yii::t('app', 'Token'),
            'request_time' => Yii::t('app', 'Request Time'),
            'responded' => Yii::t('app', 'Responded'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function generateUniqueRandomString($attribute, $length = 32)
    {
        $randomString = Yii::$app->getSecurity()->generateRandomString($length);

        if(!$this->findOne([$attribute => $randomString]))
            return $randomString;
        else
            return $this->generateUniqueRandomString($attribute, $length);
    }
}
