<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 23/1/18
 * Time: 9:53 PM
 */

use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

/** @var $this \yii\web\View */
/** @var $user \backend\modules\user\models\User */
/** @var $model \frontend\models\UpdateProfileForm */

$this->title = Yii::t('app', 'Update Profile');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['disabled' => true]) ?>

            <?= $form->field($model, 'emailAddress')->textInput(['disabled' => true]) ?>

            <?= $form->field($model, 'firstName')->textInput() ?>

            <?= $form->field($model, 'lastName')->textInput() ?>

            <?= $form->field($model, 'mobile')->textInput() ?>

            <?= $form->field($model, 'gender')->dropDownList(['male' => 'Male', 'female' => 'Female'], ['prompt' => 'Select']) ?>

            <?= $form->field($model, 'address')->textInput() ?>

            <?= $form->field($model, 'about')->textarea(['rows' => 2]) ?>

            <div class="form-group">
                <?= Html::submitButton('Update Profile', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
