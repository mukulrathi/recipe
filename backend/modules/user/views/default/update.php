<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\User */

$this->title = 'Update User: ' . $model->userProfile->getName();
$this->params['breadcrumbs'][] = ['label' => 'User Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->userProfile->getName(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?>
            </h3>
        </div>
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
                'modelProfile' => $modelProfile,
                'modelshopaddress' => $modelshopaddress,
                'modelshopdetails' => $modelshopdetails,
                'modelShopServices' => $modelShopServices,
                'modelShopDays' => $modelShopDays,

            ]) ?>
        </div>
    </div>
</div>
