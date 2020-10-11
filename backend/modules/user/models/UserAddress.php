<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_address".
 *
 * @property int $user_id
 * @property string $address_line
 * @property string $locality
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $postal_code
 * @property string $latitude
 * @property string $longitude
 *
 * @property User $user
 */
class UserAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['address_line', 'locality', 'city', 'state', 'country', 'postal_code', 'latitude', 'longitude'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
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
            'address_line' => Yii::t('app', 'Address Line'),
            'locality' => Yii::t('app', 'Locality'),
            'city' => Yii::t('app', 'City'),
            'state' => Yii::t('app', 'State'),
            'country' => Yii::t('app', 'Country'),
            'postal_code' => Yii::t('app', 'Postal Code'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
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
