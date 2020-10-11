<?php

namespace backend\modules\cms\models;

use Yii;

/**
 * This is the model class for table "cms_gallay".
 *
 * @property integer $image_id
 * @property integer $cms_id
 * @property string $image
 *
 * @property CmsItem $cms
 */
class CmsGallay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_gallay';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cms_id', 'image'], 'required'],
            [['cms_id'], 'integer'],
            [['image'], 'string', 'max' => 250],
            [['cms_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsItem::className(), 'targetAttribute' => ['cms_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'image_id' => 'Image ID',
            'cms_id' => 'Cms ID',
            'image' => 'Image',
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
