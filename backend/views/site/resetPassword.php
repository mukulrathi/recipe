<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Reset Password';

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    
    <!-- /.login-logo -->
    <div class="login-box-body">

        <div class="login-logo">
            <a href="<?= Url::to(['/site/index'], true)?>"><b><?= Yii::$app->name?></b></a>
        </div>

        <p class="login-box-msg">Reset Password</p>

        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

        <?= $form->field($model, 'password', $fieldOptions2)->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <?= Html::submitButton('Update Password', ['class' => 'btn btn-primary btn-block btn-flat']) ?>


        <?php ActiveForm::end(); ?>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
