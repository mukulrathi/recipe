<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\Assignment */
/* @var $usernameField string */
/* @var $extraColumns string[] */

$this->title = Yii::t('rbac-admin', 'Assignments');
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    ['class' => 'yii\grid\SerialColumn'],
    $usernameField,
];
if (!empty($extraColumns)) {
    $columns = array_merge($columns, $extraColumns);
}
$columns[] = [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{view}',
    'buttons' => [
        'view' => function ($url, $model, $key) {
            return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>', $url, ['class' => 'btn btn-primary btn-xs', 'title' => 'View']);
        },
    ],
];
?>
<div class="assignment-index">

    <h1 style="margin: 0; display: inline-block"><?= Html::encode($this->title) ?></h1>
    <div class="clearfix"></div>
    <hr>

    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
        'layout' => '<div class="text-right">{summary}</div>{items}<div class="text-center">{pager}</div>',
        'summaryOptions' => [
            'tag' => 'p'
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>

</div>
