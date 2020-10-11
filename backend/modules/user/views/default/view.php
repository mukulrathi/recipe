<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use alkurn\easythumbnail\EasyThumbnailImage;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\User */

$this->title = $model->userProfile->getName();
$this->params['breadcrumbs'][] = ['label' => 'User Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="box-body box-profile">
                    <?// Easy::thumbnailImg($model->userProfile->avatar, 160, 160, EasyThumbnailImage::THUMBNAIL_OUTBOUND, ['class' => 'profile-user-img img-responsive img-circle'], 95) ?>
                    <hr>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'label' => 'Address Line',
                                'attribute' => 'userShopAddress.address_line'
                            ],
                            [
                                'label' => 'City',
                                'attribute' => 'userAddress.city',
                                'value' => function ($model) {
                                    return isset($model->userShopAddress->city) ? $model->userShopAddress->city : "-";
                                },
                            ],
                            [
                                'label' => 'State',
                                'attribute' => 'userAddress.state_id',
                                'value' => function ($model) {
                                    return isset($model->userShopAddress->state) ? $model->userShopAddress->state : "-";
                                },
                            ],
                            [
                                'label' => 'Country',
                                'attribute' => 'userAddress.country_id',
                                'value' => function ($model) {
                                    return isset($model->userShopAddress->country) ? $model->userShopAddress->country : "-";
                                },
                            ],
                            [
                                'label' => 'Zip Code',
                                'attribute' => 'userAddress.postal_code',
                                'value' => function ($model) {
                                    return $model->userShopAddress->postal_code;
                                },
                            ],
                        ],
                    ]) ?>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Basic Details</h3>
                    <div class="pull-right">
                        <?= Html::a('<i class="fa fa-arrow-left" aria-hidden="true"></i> List', ['index'], ['class' => 'btn btn-info btn-xs']) ?>
                        <?= Html::a('<i class="fa fa-user-plus" aria-hidden="true"></i> Add New User', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                        <?= Html::a('<i class="fa fa-pencil" aria-hidden="true"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-xs']) ?>
                        <?php if (!$model->hasRole('admin')) { ?>
                            <?= Html::a('<i class="fa fa-trash" aria-hidden="true"></i> Delete', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger btn-xs',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="box-body">

                    <?= DetailView::widget([
                        'model' => $model,
                        'formatter' => [
                            'class' => 'yii\i18n\Formatter',
                            'nullDisplay' => '-'
                        ],
                        'attributes' => [
                            'id',
                            'username',
                            'email:email',
                            [
                                'label' => 'Roles',
                                'attribute' => 'user_id',
                                'value' => function ($model) {
                                    return implode(', ', $model->getAssignedRoles());
                                },
                            ],
                            [
                                'label' => 'Status',
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    return $model->getStatus();
                                }
                            ],

                            [
                                'label' => 'Mobile',
                                'attribute' => 'userProfile.mobile'
                            ],
                            [
                                'label' => 'Joined On',
                                'attribute' => 'created_at',
                                'format' => ['datetime']
                            ],
                        ],
                    ]) ?>
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Html::encode("Services") ?></h3>
                </div>

            </div>
        </div>

    </div>

</div>
