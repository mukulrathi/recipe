<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SystemLog */

$this->title = Yii::t('app', 'Error #{id}', ['id' => $model->id]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'System Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-log-view">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= $this->title ?></h3>
            <div class="pull-right">
                <?php echo Html::a('<i class="fa fa-trash"></i> ' . Yii::t('app', 'Delete'), false, ['class' => 'btn btn-danger btn-xs', 'data-confirm' => 'Are you sure you want to delete?', 'data-method' => 'post']) ?>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'level',
                    'category',
                    [
                        'attribute' => 'log_time',
                        'format' => 'datetime',
                        'value' => (int)$model->log_time
                    ],
                    'prefix:ntext',
                    [
                        'attribute' => 'message',
                        'format' => 'raw',
                        'value' => Html::tag('pre', $model->message, ['style' => 'white-space: pre-wrap'])
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>
