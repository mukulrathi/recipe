<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $avatar
 *
 * @property User $user
 */
class UserProfile extends \yii\db\ActiveRecord
{
    public $role;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['first_name', 'last_name', 'mobile'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
            ['mobile','number'],
            ['mobile','required'],
            ['mobile','unique'],
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
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'mobile' => Yii::t('app', 'Mobile'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        if(!empty($this->first_name) && !empty($this->last_name)) {
            return sprintf('%s %s', $this->first_name, $this->last_name);
        } else {
            return sprintf('%s', ucfirst($this->user->username));
        }
    }
}
