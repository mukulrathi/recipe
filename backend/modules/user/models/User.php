<?php

namespace backend\modules\user\models;

use Yii;
use yii\helpers\ArrayHelper;
use alkurn\blog\models\BlogPost;
use common\models\User as BaseUser;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BlogPost[] $blogPosts
 * @property UserAddress $userAddress
 * @property UserDocumentVerification[] $userDocumentVerifications
 * @property UserNotification $userNotification
 * @property UserProfile $userProfile
 * @property UserShopAddress $userShopAddress
* @property UserShopDetails $userShopDetails
* @property UserShopExtendedDetails $userShopExtendedDetails
* @property UserShopImages[] $userShopImages
* @property UserShopOffers[] $userShopOffers
* @property UserShopWorkDays[] $userShopWorkDay
* @property UserShopServices[] $userShopServices

* @property UserItem[] $userItems
* @property UserOrder[] $userOrders
* @property UserOrder[] $userOrders0
 */
class User extends BaseUser
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key'], 'required'],
            [['password_hash'], 'required', 'when' => function($model) {
                return $model->isNewRecord;
            }, 'whenClient' => 'function(attribute, value) {
                return $("#user-id").length == 0;
            }'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            ['status','required'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAddress()
    {
        return $this->hasOne(UserAddress::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDocumentVerifications()
    {
        return $this->hasMany(UserDocumentVerification::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserNotification()
    {
        return $this->hasOne(UserNotification::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfile()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfileApprovals()
    {
        return $this->hasMany(UserProfileApproval::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSocialAuths()
    {
        return $this->hasMany(UserSocialAuth::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserVerification()
    {
        return $this->hasOne(UserVerification::className(), ['user_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return UserStatus::getLabel($this->status);
    }

    /**
     * Get assigned roles of user
     *
     * @return array
     */
    public function getAssignedRoles()
    {
        $roles = Yii::$app->authManager->getRolesByUser($this->id);
        unset($roles['guest']);
        return ArrayHelper::getColumn($roles, function($element) {
            return ucwords($element->name);
        });
    }

    /**
     * Get current role of user
     *
     * @return mixed|\yii\rbac\Role
     */
    public function getUserRole()
    {
        $roles = Yii::$app->authManager->getRolesByUser($this->id);
        unset($roles['guest']);
        return current($roles);
    }

    /**
     * Check if user has the requested role
     *
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return array_key_exists($role, Yii::$app->authManager->getRolesByUser($this->id));
    }

    public function getIsEmailVerified()
    {
        return (isset($this->userVerification->responded) && $this->userVerification->responded == 1) ? 'Yes' : 'No';
    }

    public function isEmailVerified()
    {
        return (isset($this->userVerification->responded) && $this->userVerification->responded == 1);
    }

    public function getUserShopWorkDays()
   {
       return $this->hasMany(UserShopWorkDays::className(), ['user_id' => 'id']);
   }

   public function getUserShopOffers()
   {
    
       return $this->hasMany(UserShopOffers::className(), ['user_id' => 'id']);
   }
    
      /**
    * @return \yii\db\ActiveQuery
    */
 

   public function getUserShopImages()
   {
        return $this->hasMany(UserShopImages::className(), ['user_id' => 'id']);
   }


      /**
    * @return \yii\db\ActiveQuery
    */
 


   public function getUserShopExtendedDetails()
   {
          return $this->hasOne(UserShopExtendedDetails::className(), ['user_id' => 'id']);
   }
      /**
    * @return \yii\db\ActiveQuery
    */
 

   public function getUserShopDetails()
   {
       return $this->hasOne(UserShopDetails::className(), ['user_id' => 'id']);
   }

     /**
    * @return \yii\db\ActiveQuery
    */
  
   public function getUserShopAddress()
   {
       return $this->hasOne(UserShopAddress::className(), ['user_id' => 'id']);
   }

   /**
    * @return \yii\db\ActiveQuery
    */
 

    public function getUserOrders0()
   {
          return $this->hasMany(UserOrder::className(), ['user_id' => 'id']);
 
    }

   public function getUserOrders()
   {
       return $this->hasMany(UserOrder::className(), ['shop_id' => 'id']);
   }

   public function getUserShopServices()
   {
       return $this->hasMany(UserShopServices::className(), ['user_id' => 'id']);
   }


}
