<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_document_verification".
 *
 * @property int $id
 * @property int $user_id
 * @property string $file_path
 * @property string $status
 * @property string $reason
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class UserDocumentVerification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_document_verification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'file_path'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['status', 'reason'], 'string'],
            [['file_path'], 'string', 'max' => 500],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'file_path' => Yii::t('app', 'File Path'),
            'status' => Yii::t('app', 'Status'),
            'reason' => Yii::t('app', 'Reason'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
