<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 12/10/17
 * Time: 5:17 PM
 */

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\search\UserProfileApprovalSearch */
/* @var $form yii\widgets\ActiveForm */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$statuses = \backend\modules\user\models\UserProfileApprovalStatus::listData();
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'status')->dropDownList($statuses, ['prompt' => 'All']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>