<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\Menu */

$this->title = Yii::t('rbac-admin', 'Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">
    <h1 style="margin: 0; display: inline-block"><?= Html::encode($this->title) ?></h1>
    <div class="pull-right">
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> ' . Yii::t('rbac-admin', 'Add New Menu'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
    </div>
    <div class="clearfix"></div>
    <hr>

    <?php Pjax::begin(); ?>
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
            'name',
            [
                'attribute' => 'menuParent.name',
                'filter' => Html::activeTextInput($searchModel, 'parent_name', [
                    'class' => 'form-control', 'id' => null
                ]),
                'label' => Yii::t('rbac-admin', 'Parent'),
            ],
            'route',
            'order',
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
    ]);
    ?>
<?php Pjax::end(); ?>

</div>
