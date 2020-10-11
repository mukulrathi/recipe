<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use backend\models\AdminTemplate;

/** @var $this \yii\web\View */
/** @var $model \backend\models\SocialAuthConfiguration*/
$this->title = "Social Auth Configuration";
?>

<div class="settings">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title)?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'enableSocialAuth')->checkbox()?>

            <div class="field-container" <?= !(bool) $model->enableSocialAuth ? 'style="display: none;"' : ''?>>

                <?= $form->field($model, 'enableFacebookAuth')->checkbox()?>

                <div class="facebook-settings-container" <?= !(bool) $model->enableFacebookAuth ? 'style="display: none;"' : ''?>>
                    <?= $form->field($model, 'facebookClientId')->textInput()?>

                    <?= $form->field($model, 'facebookClientSecret')->textInput()?>
                </div>

                <?= $form->field($model, 'enableGooglePlusAuth')->checkbox()?>

                <div class="google-plus-settings-container" <?= !(bool) $model->enableGooglePlusAuth ? 'style="display: none;"' : ''?>>
                    <?= $form->field($model, 'googlePlusClientId')->textInput()?>

                    <?= $form->field($model, 'googlePlusClientSecret')->textInput()?>
                </div>

            </div>

            <?php echo Html::submitButton(Yii::t('app', 'Update Settings'), ['class' => 'btn btn-success']) ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

<?php

$js = <<<JS
$('#socialauthconfiguration-enablesocialauth').on('change', function() {
    if($(this).is(':checked')) {
        $('.field-container').show();
    } else {
        $('.field-container').hide();
    }
});

$('#socialauthconfiguration-enablefacebookauth').on('change', function() {
    if($(this).is(':checked')) {
        $('.facebook-settings-container').show();
    } else {
        $('.facebook-settings-container').hide();
    }
});

$('#socialauthconfiguration-enablegoogleplusauth').on('change', function() {
    if($(this).is(':checked')) {
        $('.google-plus-settings-container').show();
    } else {
        $('.google-plus-settings-container').hide();
    }
});

/*$('#socialauthconfiguration-enabletwitterauth').on('change', function() {
    if($(this).is(':checked')) {
        $('.twitter-settings-container').show();
    } else {
        $('.twitter-settings-container').hide();
    }
});*/
JS;

$this->registerJs($js);