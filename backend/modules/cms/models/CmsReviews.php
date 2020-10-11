<?php

namespace backend\modules\cms\models;

use Yii;

/**
 * This is the model class for table "cms_reviews".
 *
 * @property integer $review_id
 * @property integer $cms_id
 * @property string $email
 * @property string $ratting
 * @property string $review
 * @property integer $status
 * @property string $date_modified
 * @property integer $created_at
 *
 * @property CmsComments $cmsComments
 * @property CmsItem $cms
 */
class CmsReviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cms_id', 'email', 'ratting', 'review', 'created_at'], 'required'],
            [['cms_id', 'status', 'created_at'], 'integer'],
            [['review'], 'string'],
            [['date_modified'], 'safe'],
            [['email', 'ratting'], 'string', 'max' => 64],
            [['cms_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsItem::className(), 'targetAttribute' => ['cms_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'review_id' => 'Review ID',
            'cms_id' => 'Cms ID',
            'email' => 'Email',
            'ratting' => 'Ratting',
            'review' => 'Review',
            'status' => 'Status',
            'date_modified' => 'Date Modified',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsComments()
    {
        return $this->hasOne(CmsComments::className(), ['review_id' => 'review_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCms()
    {
        return $this->hasOne(CmsItem::className(), ['id' => 'cms_id']);
    }
}
