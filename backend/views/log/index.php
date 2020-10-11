<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SystemLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'System Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-log-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= $this->title?></h3>
            <div class="pull-right">
                <?php echo Html::a('<i class="fa fa-trash"></i> ' . Yii::t('app', 'Clear'), false, ['class' => 'btn btn-danger btn-xs', 'data-method'=>'delete']) ?>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout' => '<div class="text-right">{summary}</div>{items}<div class="text-center">{pager}</div>',
                'summaryOptions' => [
                    'tag' => 'p'
                ],
                'options' => [
                    'class' => 'grid-view table-responsive'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute'=>'level',
                        'value'=>function ($model) {
                            return \yii\log\Logger::getLevelName($model->level);
                        },
                        'filter'=>[
                            \yii\log\Logger::LEVEL_ERROR => 'error',
                            \yii\log\Logger::LEVEL_WARNING => 'warning',
                            \yii\log\Logger::LEVEL_INFO => 'info',
                            \yii\log\Logger::LEVEL_TRACE => 'trace',
                            \yii\log\Logger::LEVEL_PROFILE_BEGIN => 'profile begin',
                            \yii\log\Logger::LEVEL_PROFILE_END => 'profile end'
                        ]
                    ],
                    'category',
                    'prefix',
                    [
                        'attribute' => 'log_time',
                        'format' => 'datetime',
                        'value' => function ($model) {
                            return (int) $model->log_time;
                        }
                    ],
                    [
                        'class'=>'kartik\grid\ActionColumn',
                        'dropdown'=> true,
                        'header' => 'Actions',
                        'dropdownOptions'=>['class'=>'pull-right'],
                        'dropdownButton' => ['class' => 'btn btn-default btn-xs'],
                        'template' => '{view} {delete} ',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                $a = Html::a('<i class="fa fa-eye" aria-hidden="true"></i> View', $url, ['title' => 'View']);
                                return Html::tag('li', $a);
                            },
                            'delete' => function ($url, $model, $key) {
                                $a = Html::a('<i class="fa fa-trash" aria-hidden="true"></i> Delete', $url, ['title' => 'Delete', 'data-method' => 'POST', 'data-confirm' => 'Are you sure you want to delete?']);
                                return Html::tag('li', $a);
                            },
                        ],
                    ],
                ]
            ]); ?>
        </div>
    </div>



</div>
