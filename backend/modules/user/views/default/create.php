<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\User */

$this->title = 'Add New User';
$this->params['breadcrumbs'][] = ['label' => 'User Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
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
