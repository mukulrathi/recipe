<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_shop_extended_details".
 *
 * @property string $user_id
 * @property string $details
 * @property int $start_time
 * @property int $end_time
 *
 * @property User $user
 */
class UserShopExtendedDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_shop_extended_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'start_time', 'end_time'], 'required'],
            [['user_id', 'start_time', 'end_time'], 'integer'],
            [['details'], 'string'],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'details' => 'Details',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
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
