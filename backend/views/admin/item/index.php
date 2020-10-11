<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\RouteRule;
use mdm\admin\components\Configs;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\AuthItem */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', $labels['Items']);
$this->params['breadcrumbs'][] = $this->title;

$rules = array_keys(Configs::authManager()->getRules());
$rules = array_combine($rules, $rules);
unset($rules[RouteRule::RULE_NAME]);
?>
<div class="role-index">
    <div class="pull-right">
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> ' . Yii::t('rbac-admin', 'Add New ' . $labels['Item']), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
    </div>
    <div class="clearfix"></div>
    <hr>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '<div class="text-right">{summary}</div>{items}<div class="text-center">{pager}</div>',
        'summaryOptions' => [
            'tag' => 'p'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'label' => Yii::t('rbac-admin', 'Name'),
            ],
            [
                'attribute' => 'ruleName',
                'label' => Yii::t('rbac-admin', 'Rule Name'),
                'filter' => $rules
            ],
            [
                'attribute' => 'description',
                'label' => Yii::t('rbac-admin', 'Description'),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>', $url, ['class' => 'btn btn-primary btn-xs', 'title' => 'View']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>', $url, ['class' => 'btn btn-info btn-xs', 'title' => 'Update']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', $url, ['class' => 'btn btn-danger btn-xs', 'title' => 'Delete', 'data-method' => 'POST', 'data-confirm' => 'Are you sure you want to delete?']);
                    },
                ],
            ],
        ],
    ])
    ?>

</div>
