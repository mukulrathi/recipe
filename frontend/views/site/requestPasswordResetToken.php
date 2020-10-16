<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


use frontend\assets\{SweetAlertAsset, LaddaBootstrapAsset};

SweetAlertAsset::register($this);
LaddaBootstrapAsset::register($this);


$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>


<div id="loading">
    <div id="loading-center">
    </div>
</div>
<!-- loader END -->
<!-- Sign in Start -->
<section class="sign-in-page">
    <div id="container-inside">
        <div id="circle-small"></div>
        <div id="circle-medium"></div>
        <div id="circle-large"></div>
        <div id="circle-xlarge"></div>
        <div id="circle-xxlarge"></div>
    </div>
    <div class="container p-0">
        <div class="row no-gutters">
            <div class="col-md-6 text-center pt-5">
                <div class="sign-in-detail text-white">
                    <a class="sign-in-logo mb-5" href="#"><img src="/images/logo-new.png" class="img-responsive" alt="logo"></a>
                    <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true"
                         data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1"
                         data-items-mobile-sm="1" data-margin="0">
                        <div class="item">
                            <img src="/images/login/1.png" class="img-fluid mb-4" alt="logo">
                            <h4 class="mb-1 text-white">Manage your orders</h4>
                            <p>It is a long established fact that a reader will be distracted by the readable
                                content.</p>
                        </div>
                        <div class="item">
                            <img src="/images/login/1.png" class="img-fluid mb-4" alt="logo">
                            <h4 class="mb-1 text-white">Manage your orders</h4>
                            <p>It is a long established fact that a reader will be distracted by the readable
                                content.</p>
                        </div>
                        <div class="item">
                            <img src="/images/login/1.png" class="img-fluid mb-4" alt="logo">
                            <h4 class="mb-1 text-white">Manage your orders</h4>
                            <p>It is a long established fact that a reader will be distracted by the readable
                                content.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 bg-white pt-5">
                <div class="sign-in-from">
                    <h1 class="mb-0"><?= $this->title ?></h1>
                    <p>Enter your email address to reset password</p>
                    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                    <div class="d-inline-block w-100">
                        <?= Html::submitButton('Send', ['class' => 'ladda-button btn btn-primary float-right login-button', 'name' => 'signup-button', 'data-style' => "slide-right"]) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>

</section>

<?php
$js =<<<js

var l = Ladda.create(document.querySelector('.login-button'));
var form = $("#reset-password-form");
form.on('beforeSubmit', function() {
    var formData = new FormData(this);
    recipe.commonAjax(formData,l);
        return false ;
})




js;
$this->registerJs($js);

?>



