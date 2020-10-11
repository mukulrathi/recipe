<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_shop_offers".
 *
 * @property string $id
 * @property string $user_id
 * @property string $offers_detail
 * @property string $title
 * @property string $image
 * @property string $url
 * @property double $amount
 * @property string $validupto
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class UserShopOffers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_shop_offers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title'], 'required'],
            [['user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['offers_detail'], 'string'],
            [['amount'], 'number'],
            [['validupto'], 'safe'],
            [['title', 'image', 'url'], 'string', 'max' => 255],
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
            'offers_detail' => 'Offers Detail',
            'title' => 'Title',
            'image' => 'Image',
            'url' => 'Url',
            'amount' => 'Amount',
            'validupto' => 'Validupto',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
