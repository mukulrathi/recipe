<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_shop_address".
 *
 * @property string $user_id
 * @property string $address_line
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $postal_code
 * @property string $latitude
 * @property string $longitude
 *
 * @property User $user
 */
class UserShopAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_shop_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['user_id'], 'required'],
            [['user_id'], 'integer'],
            ['address_line','required'],
            [['address_line', 'city', 'state', 'country', 'postal_code', 'latitude', 'longitude'], 'string', 'max' => 255],
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
            'address_line' => 'Address Line',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'postal_code' => 'Postal Code',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
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
