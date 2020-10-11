<?php

namespace backend\modules\cms\models;

use Yii;

/**
 * This is the model class for table "cms_media".
 *
 * @property integer $media_id
 * @property integer $cms_id
 * @property string $file
 * @property string $type
 *
 * @property CmsItem $cms
 */
class CmsMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cms_id', 'file', 'type'], 'required'],
            [['cms_id'], 'integer'],
            [['file'], 'string', 'max' => 200],
            [['type'], 'string', 'max' => 20],
            [['cms_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsItem::className(), 'targetAttribute' => ['cms_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'media_id' => 'Media ID',
            'cms_id' => 'Cms ID',
            'file' => 'File',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCms()
    {
        return $this->hasOne(CmsItem::className(), ['id' => 'cms_id']);
    }
}
