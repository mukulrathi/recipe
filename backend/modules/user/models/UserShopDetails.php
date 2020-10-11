<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_shop_details".
 *
 * @property string $user_id
 * @property string $shopname
 * @property string $mobile
 * @property string $website
 * @property string $bannerimage
 * @property string $bannerimage_path
 * @property string $plan_id
 * @property string $expire_time
 * @property string $type
 *
 * @property User $user
 */
class UserShopDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_shop_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shopname', 'mobile'], 'required'],
            [['user_id'], 'integer'],
            [['expire_time'], 'safe'],
            [['shopname', 'mobile', 'website', 'bannerimage', 'bannerimage_path', 'plan_id', 'type'], 'string', 'max' => 255],
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
            'shopname' => 'Shopname',
            'mobile' => 'Mobile',
            'website' => 'Website',
            'bannerimage' => 'Bannerimage',
            'bannerimage_path' => 'Bannerimage Path',
            'plan_id' => 'Plan ID',
            'expire_time' => 'Expire Time',
            'type' => 'Type',
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
