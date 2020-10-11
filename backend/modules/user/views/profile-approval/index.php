<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 22/4/17
 * Time: 12:36 PM
 */

use yii\grid\GridView;
use yii\bootstrap\Html;
use backend\modules\user\models\UserProfileApprovalStatus;

/** @var $this \yii\web\View */

$this->title = 'Profile Approval Request';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="user-profile-approval-index">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode('Search')?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>

        <div class="box-body">

            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'layout' => '<div class="text-right">{summary}</div>{items}<div class="text-center">{pager}</div>',
                    'summaryOptions' => [
                        'tag' => 'p'
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'label' => 'Fullname',
                            'attribute' => 'user_id',
                            'value' => function($model){
                                return $model->user->userProfile->getName();
                            },
                        ],
                        [
                            'label' => 'Rejected Reason',
                            'attribute' => 'rejection_reason',
                            'headerOptions' => [
                                'style' => 'width: 350px;'
                            ]
                        ],
                        [
                            'label' => 'Status',
                            'attribute' => 'status',
                            'value' => function($model){
                                return $model->getStatus();
                            },
                            'filter' => ['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected']
                        ],
                        'created_at:date',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {review}',
                            'buttons' => [
                                'view' => function ($url, $model, $key) {
                                    return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>', $url, ['class' => 'btn btn-primary btn-xs', 'title' => 'View']);
                                },
                                'review' => function ($url, $model, $key) {
                                    if($model->status != \backend\modules\user\models\UserProfileApprovalRequestStatus::UNDER_REVIEW && $model->status != \backend\modules\user\models\UserProfileApprovalRequestStatus::PENDING) return false;
                                    return Html::a('<i class="fa fa-search" aria-hidden="true"></i>', $url, ['class' => 'btn btn-info btn-xs modalTrigger', 'title' => 'Review']);
                                },

                            ],
                        ],
                    ],
                ]); ?>
            </div>

        </div>
    </div>
</div>

