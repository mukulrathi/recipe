<?php

namespace backend\modules\cms\models;

use Yii;

/**
 * This is the model class for table "cms_comments".
 *
 * @property integer $review_id
 * @property string $email
 * @property string $comment
 * @property string $created_at
 *
 * @property CmsReviews $review
 */
class CmsComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['review_id', 'email', 'comment'], 'required'],
            [['review_id'], 'integer'],
            [['comment'], 'string'],
            [['created_at'], 'safe'],
            [['email'], 'string', 'max' => 64],
            [['review_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsReviews::className(), 'targetAttribute' => ['review_id' => 'review_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'review_id' => 'Review ID',
            'email' => 'Email',
            'comment' => 'Comment',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReview()
    {
        return $this->hasOne(CmsReviews::className(), ['review_id' => 'review_id']);
    }
}
