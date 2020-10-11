<?php

namespace backend\modules\cms\models;

use Yii;

/**
 * This is the model class for table "cms_path".
 *
 * @property integer $cms_id
 * @property integer $path_id
 * @property integer $level
 *
 * @property CmsItem $cms
 * @property CmsItem $path
 */
class CmsPath extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_path';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cms_id', 'path_id'], 'required'],
            [['cms_id', 'path_id', 'level'], 'integer'],
            [['cms_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsItem::className(), 'targetAttribute' => ['cms_id' => 'id']],
            [['path_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsItem::className(), 'targetAttribute' => ['path_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cms_id' => 'Cms ID',
            'path_id' => 'Path ID',
            'level' => 'Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCms()
    {
        return $this->hasOne(CmsItem::className(), ['id' => 'cms_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPath()
    {
        return $this->hasOne(CmsItem::className(), ['id' => 'path_id']);
    }
}
