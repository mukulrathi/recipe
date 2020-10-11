<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\search\UserSearch */
/* @var $form yii\widgets\ActiveForm */
$authManager = Yii::$app->getAuthManager();
$roles = ArrayHelper::map($authManager->getRoles(), 'name', 'name');
unset($roles['guest']);

$statuses = \backend\modules\user\models\UserStatus::listData();
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'q')->textInput(['placeholder' => 'Search by username, email, first name or last name'])->label('Search') ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'role')->dropDownList($roles, ['prompt' => 'All']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'status')->dropDownList($statuses, ['prompt' => 'All']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'emailVerified')->dropDownList([1 => 'Yes', 0 => 'No'], ['prompt' => 'All']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
