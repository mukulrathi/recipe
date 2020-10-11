<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use backend\modules\user\models\UserStatus;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\user\models\search\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Management';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode('Search') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <div class="pull-right">
                <?= Html::a('<i class="fa fa-user-plus" aria-hidden="true"></i> ' . Yii::t('app', 'Add New User'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
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
                        'value' => function ($model) {
                            return $model->getStatus();
                        }
                    ],
                    
                    'created_at:datetime',

                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'dropdown' => true,
                        'header' => 'Actions',
                        'dropdownOptions' => ['class' => 'pull-right'],
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
                                if ($model->hasRole('admin')) return false;
                                $a = Html::a('<i class="fa fa-trash" aria-hidden="true"></i> Delete', $url, ['title' => 'Delete', 'data-method' => 'POST', 'data-confirm' => 'Are you sure you want to delete?']);
                                return Html::tag('li', $a);
                            },
                            'unblock-user' => function ($url, $model, $key) {
                                if ($model->status == UserStatus::BLOCKED) {
                                    $a = Html::a('<i class="fa fa-check" aria-hidden="true"></i> Unblock', $url, ['title' => 'Unblock', 'data-method' => 'POST', 'data-confirm' => 'Are you sure you want to unblock this user?']);
                                    return Html::tag('li', $a);
                                }
                                return '';
                            },
                            'block-user' => function ($url, $model, $key) {
                                if ($model->status != UserStatus::ACTIVE && $model->id != 1) {
                                    $a = Html::a('<i class="fa fa-times" aria-hidden="true"></i> Block', $url, ['title' => 'Block', 'data-method' => 'POST', 'data-confirm' => 'Are you sure you want to block this user?']);
                                    return Html::tag('li', $a);
                                }
                                return '';
                            },
                            'suspend-user' => function ($url, $model, $key) {
                                if ($model->status != UserStatus::SUSPENDED && $model->id != 1) {
                                    $a = Html::a('<i class="fa fa-ban" aria-hidden="true"></i> Suspend', $url, ['title' => 'Suspend', 'data-method' => 'POST', 'data-confirm' => 'Are you sure you want to suspend this user?']);
                                    return Html::tag('li', $a);
                                }
                                return '';
                            },
                            'resend-verification-token' => function ($url, $model, $key) {
                                if ((isset($model->userVerification->responded) && $model->userVerification->responded == 1)) return false;
                                $a = Html::a('<i class="fa fa-paper-plane" aria-hidden="true"></i> Resend Verification Mail', $url, ['title' => 'Resend Verification Token']);
                                return Html::tag('li', $a);
                            },
                            'mark-email-verified' => function ($url, $model, $key) {
                                if ((isset($model->userVerification->responded) && $model->userVerification->responded == 1)) return false;
                                $a = Html::a('<i class="fa fa-check-square-o" aria-hidden="true"></i> Mark Email Verified', $url, ['title' => 'Mark Email Verified', 'data-method' => 'post', 'data-confirm' => 'Are you sure you want to mark email verified this user?']);
                                return Html::tag('li', $a);
                            }
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
