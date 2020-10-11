<?php

namespace backend\modules\cms\models;

use Yii;

/**
 * This is the model class for table "cms_item".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $layout_id
 * @property string $slug
 * @property string $external_url
 * @property string $title
 * @property string $content
 * @property integer $restricted
 * @property integer $status
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $create_date
 * @property string $modified_date
 *
 * @property CmsBlockMapper[] $cmsBlockMappers
 * @property CmsBlock[] $blocks
 * @property CmsCategoryMapper[] $cmsCategoryMappers
 * @property CmsCategory[] $categories
 * @property CmsFieldValue[] $cmsFieldValues
 * @property CmsGallay[] $cmsGallays
 * @property CmsItem $parent
 * @property CmsItem[] $cmsItems
 * @property CmsLayout $layout
 * @property CmsMedia[] $cmsMedia
 * @property CmsPath[] $cmsPaths
 * @property CmsPath[] $cmsPaths0
 * @property CmsItem[] $paths
 * @property CmsItem[] $cms
 * @property CmsRatting $cmsRatting
 * @property CmsRelation[] $cmsRelations
 * @property CmsKeyword[] $keywords
 * @property CmsReviews[] $cmsReviews
 * @property CmsWidgetMapper[] $cmsWidgetMappers
 * @property CmsWidget[] $widgets
 */
class CmsItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'layout_id', 'restricted', 'status'], 'integer'],
            [['slug'], 'required'],
            [['content', 'meta_title', 'meta_description', 'meta_keywords'], 'string'],
            [['create_date', 'modified_date'], 'safe'],
            [['slug'], 'string', 'max' => 100],
            [['external_url', 'title'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsItem::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['layout_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsLayout::className(), 'targetAttribute' => ['layout_id' => 'layout_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'layout_id' => 'Layout ID',
            'slug' => 'Slug',
            'external_url' => 'External Url',
            'title' => 'Title',
            'content' => 'Content',
            'restricted' => 'Restricted',
            'status' => 'Status',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'create_date' => 'Create Date',
            'modified_date' => 'Modified Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockMappers()
    {
        return $this->hasMany(CmsBlockMapper::className(), ['cms_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlocks()
    {
        return $this->hasMany(CmsBlock::className(), ['block_id' => 'block_id'])->viaTable('cms_block_mapper', ['cms_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsCategoryMappers()
    {
        return $this->hasMany(CmsCategoryMapper::className(), ['cms_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(CmsCategory::className(), ['category_id' => 'category_id'])->viaTable('cms_category_mapper', ['cms_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsFieldValues()
    {
        return $this->hasMany(CmsFieldValue::className(), ['cms_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsGallays()
    {
        return $this->hasMany(CmsGallay::className(), ['cms_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(CmsItem::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsItems()
    {
        return $this->hasMany(CmsItem::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLayout()
    {
        return $this->hasOne(CmsLayout::className(), ['layout_id' => 'layout_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsMedia()
    {
        return $this->hasMany(CmsMedia::className(), ['cms_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPaths()
    {
        return $this->hasMany(CmsPath::className(), ['cms_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPaths0()
    {
        return $this->hasMany(CmsPath::className(), ['path_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaths()
    {
        return $this->hasMany(CmsItem::className(), ['id' => 'path_id'])->viaTable('cms_path', ['cms_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCms()
    {
        return $this->hasMany(CmsItem::className(), ['id' => 'cms_id'])->viaTable('cms_path', ['path_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsRatting()
    {
        return $this->hasOne(CmsRatting::className(), ['cms_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsRelations()
    {
        return $this->hasMany(CmsRelation::className(), ['cms_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeywords()
    {
        return $this->hasMany(CmsKeyword::className(), ['keyword_id' => 'keyword_id'])->viaTable('cms_relation', ['cms_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsReviews()
    {
        return $this->hasMany(CmsReviews::className(), ['cms_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsWidgetMappers()
    {
        return $this->hasMany(CmsWidgetMapper::className(), ['cms_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWidgets()
    {
        return $this->hasMany(CmsWidget::className(), ['widget_id' => 'widget_id'])->viaTable('cms_widget_mapper', ['cms_id' => 'id']);
    }
}
