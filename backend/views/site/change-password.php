<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Change password';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= $this->title?></h3>
        </div>
        <div class="box-body">
            <div class="forgot-password">
                <p>Please choose your new password:</p>
                <?php $form = ActiveForm::begin(['id' => 'change-password-form']); ?>

                <?= $form->field($model, 'old_password')->passwordInput() ?>

                <?= $form->field($model, 'new_password')->passwordInput() ?>

                <?= $form->field($model, 'new_password_repeat')->passwordInput() ?>

                <div class="button-container">
                    <?= Html::submitButton('Change Password', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</section>

