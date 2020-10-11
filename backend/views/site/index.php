<?php

use yii\bootstrap\Html;
use kartik\grid\GridView;
use backend\modules\user\models\UserStatus;
use backend\modules\user\models\UserProfileApprovalStatus;
/* @var $this yii\web\View */

$this->title = 'Dashboard';
$colors = [
    'bg-aqua',
    'bg-blue',
    'bg-green',
    'bg-navy',
    'bg-teal',
    'bg-olive',
    'bg-lime',
    'bg-orange',
    'bg-fuchsia',
    'bg-purple',
    'bg-maroon',
    'bg-black',
    'bg-light-blue',
];
?>
<div class="site-index">
    <div class="row">
        <?php foreach ($count as $key => $c) { ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon <?= isset($colors[$key]) ? $colors[$key] : 'bg-aqua'?>"><i class="fa fa-users fa-5a"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" title="<?= $c['name'] ?>"><?= $c['name'] ?></span>
                        <span class="info-box-number"><?= $c['count'] ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        <?php } ?>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest Users</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <p>
                        <button id="delete-multiple" class="btn btn-danger btn-xs multiple-delete"
                                style="display: none">Delete Selected
                        </button>
                    </p>
                    <div class="table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $users,
                            'layout' => '<div class="text-right">{summary}</div>{items}<div class="text-center">{pager}</div>',
                            'summaryOptions' => [
                                'tag' => 'p'
                            ],
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'id',
                                [
                                    'label' => 'Full Name',
                                    'attribute' => 'userProfile.name',
                                ],
                                'email:email',
                                
                                [
                                    'label' => 'Status',
                                    'attribute' => 'status',
                                    'value' => function($model) {
                                        return $model->getStatus();
                                    }
                                ],
                                
                                'created_at:datetime',

                                [
                                    'class'=>'kartik\grid\ActionColumn',
                                    'dropdown'=> true,
                                    'controller' => 'user/default',
                                    'header' => 'Actions',
                                    'dropdownOptions'=>['class'=>'pull-right'],
                                    'dropdownButton' => ['class' => 'btn btn-default btn-xs'],
                                    'template' => '{block-user} {unblock-user} {suspend-user} {resend-verification-token} {mark-email-verified} {view} {update} {delete} ',
                                    'buttons' => [
                                        'view' => function ($url, $model, $key) {
                                            $a = Html::a('<i class="fa fa-eye" aria-hidden="true"></i> View', $url, ['title' => 'View']);
                                            return Html::tag('li', $a);
                                        },
                                        'update' => function ($url, $model, $key) {
                                            $a = Html::a('<i class="fa fa-pencil" aria-hidden="true"></i> Update', $url, ['title' => 'Update']);
                                            return Html::tag('li', $a);
                                        },
                                        'delete' => function ($url, $model, $key) {
                                            if($model->hasRole('admin')) return false;
                                            $a = Html::a('<i class="fa fa-trash" aria-hidden="true"></i> Delete', $url, ['title' => 'Delete', 'data-method' => 'POST', 'data-confirm' => 'Are you sure you want to delete?']);
                                            return Html::tag('li', $a);
                                        },
                                        'unblock-user' => function ($url, $model, $key) {
                                            if($model->status == UserStatus::BLOCKED) {
                                                $a = Html::a('<i class="fa fa-check" aria-hidden="true"></i> Unblock', $url, ['title' => 'Unblock', 'data-method' => 'POST', 'data-confirm' => 'Are you sure you want to unblock this user?']);
                                                return Html::tag('li', $a);
                                            }
                                            return '';
                                        },
                                        'block-user' => function ($url, $model, $key) {
                                            if($model->status != UserStatus::ACTIVE && $model->id != 1) {
                                                $a = Html::a('<i class="fa fa-times" aria-hidden="true"></i> Block', $url, ['title' => 'Block', 'data-method' => 'POST', 'data-confirm' => 'Are you sure you want to block this user?']);
                                                return Html::tag('li', $a);
                                            }
                                            return '';
                                        },
                                        'suspend-user' => function ($url, $model, $key) {
                                            if($model->status != UserStatus::SUSPENDED && $model->id != 1) {
                                                $a = Html::a('<i class="fa fa-ban" aria-hidden="true"></i> Suspend', $url, ['title' => 'Suspend', 'data-method' => 'POST', 'data-confirm' => 'Are you sure you want to suspend this user?']);
                                                return Html::tag('li', $a);
                                            }
                                            return '';
                                        },
                                        'resend-verification-token' => function($url, $model, $key) {
                                            if((isset($model->userVerification->responded) && $model->userVerification->responded == 1)) return false;
                                            $a = Html::a('<i class="fa fa-paper-plane" aria-hidden="true"></i> Resend Verification Mail', $url, ['title' => 'Resend Verification Token']);
                                            return Html::tag('li', $a);
                                        },
                                        'mark-email-verified' => function($url, $model, $key) {
                                            if((isset($model->userVerification->responded) && $model->userVerification->responded == 1)) return false;
                                            $a = Html::a('<i class="fa fa-check-square-o" aria-hidden="true"></i> Mark Email Verified', $url, ['title' => 'Mark Email Verified', 'data-method' => 'post', 'data-confirm' => 'Are you sure you want to mark email verified this user?']);
                                            return Html::tag('li', $a);
                                        }
                                    ],
                                ],
                            ],
                        ]); ?>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="<?= \yii\helpers\Url::to(['/user/default/index'], true) ?>"
                       class="btn btn-sm btn-default btn-flat pull-right">View All Users</a>
                </div>
                <!-- /.box-footer -->
            </div>

        </div>
    </div>
</div>
