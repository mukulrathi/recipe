<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_shop_work_days".
 *
 * @property string $id
 * @property string $user_id
 * @property string $days
 *
 * @property User $user
 */
class UserShopWorkDays extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_shop_work_days';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['days'], 'required'],
            [['days'], 'safe'],
            [['user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'days' => 'Days',
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
