<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use backend\models\AdminTemplate;
use wbraganca\tagsinput\TagsinputWidget;

/** @var $this \yii\web\View */
/** @var $model \backend\models\SiteConfiguration*/
$this->title = "Site Configuration";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="settings">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title)?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

            <?php echo $form->field($model, 'appName'); ?>

            <?php echo $form->field($model, 'adminEmail'); ?>

            <?php echo $form->field($model, 'googleAutocompleteApiKey'); ?>

            <?php echo $form->field($model, 'adminTheme')->dropDownList(AdminTemplate::listData()); ?>

            <?php echo $form->field($model, 'copyrightYear'); ?>

            <?php echo $form->field($model, 'seoDescription')->textarea(['rows' => 2]); ?>

            <?= $form->field($model, 'seoKeywords')->widget(TagsinputWidget::classname(), [
                'clientOptions' => [
                    'trimValue' => true,
                    'allowDuplicates' => false
                ]
            ]) ?>

            <?php echo $form->field($model, 'seoContactDescription')->textarea(['rows' => 2]); ?>

            <?php echo $form->field($model, 'projectAdSenseCode')->textarea(['rows' => 2]); ?>

            <?php echo $form->field($model, 'googleAnalyticsCode')->textarea(['rows' => 2]); ?>

            <?php echo $form->field($model, 'loginAfterEmailVerification')->checkbox(); ?>

            <?php echo $form->field($model, 'enableProfileApproval')->checkbox(); ?>

            <?php echo $form->field($model, 'enableRobots')->checkbox(); ?>

            <?php echo Html::submitButton(Yii::t('app', 'Update Settings'), ['class' => 'btn btn-success']) ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
