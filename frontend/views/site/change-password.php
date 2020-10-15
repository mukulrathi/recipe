<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\{SweetAlertAsset,LaddaBootstrapAsset};
SweetAlertAsset::register($this);
LaddaBootstrapAsset::register($this);
$this->title = 'Change password';
?>

<div id="content-page" class="content-page">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="iq-card">

                    <div class="iq-card-body">
                        <?php $form = ActiveForm::begin(['id' => 'change-password-form']); ?>

                        <?= $form->field($model, 'old_password')->passwordInput() ?>

                        <?= $form->field($model, 'new_password')->passwordInput() ?>

                        <?= $form->field($model, 'new_password_repeat')->passwordInput() ?>

                        <div class="button-container">
                            <?= Html::submitButton('Change Password', ['class' => 'btn btn-primary password-button ladda-button','name' => 'signup-button', 'data-style' => "slide-right"]) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$js =<<<js

var l = Ladda.create(document.querySelector('.password-button'));
var form = $("#change-password-form");

form.on('beforeSubmit', function() {
    var formData = new FormData(this);
    recipe.commonAjax(formData,l);
        return false ;
})
js;
$this->registerJs($js);
