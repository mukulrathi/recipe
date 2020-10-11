<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 22/2/17
 * Time: 6:44 PM
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>

<?php $form = ActiveForm::begin(['id' => 'profile-review-form']); ?>

<?= $form->field($model, 'status')->dropDownList([ 'approved' => 'Approve', 'rejected' => 'Reject', ], ['prompt' => 'Select Status', 'class' => 'form-control status']) ?>

    <div id="reason_div" style="display: none;">
        <?= $form->field($model, 'reason')->textarea(['rows' => 4]) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Change Status', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

<?php

$js = <<<JS

$('.status').on('change', function() {
    if($(this).val() == 'rejected') {
        $('#reason_div').show();
    } else {
        $('#reason_div').hide();
    }
});

$('#profile-review-form').on('beforeSubmit', function() {
    $('.modal-loader-overlay').show();
    $.ajax({
        url: $(this).attr('action'),
        type: 'post',
        data: new FormData(this),
        cache:false,
        contentType: false,
        processData: false,
        success: function(response) {
            $('.modal-loader-overlay').hide();
            if(response.flag) {
                $('#globalModal').modal('hide');
                location.reload();
            } else {
                if(typeof response.errors == "string") {
                    alert(response.errors);
                } else {
                    $.each(response.errors, function(i, v) {
                        $('.field-profilereviewform-' + i).removeClass('has-success').addClass('has-error');
                        $('.field-profilereviewform-' + i + ' > .help-block').text(v[0]);
                    })
                }
            }
        },
        error: function() {
            $('.modal-loader-overlay').hide();
            alert('An error occurred while processing your request.')
        }
    });
    return false;
});

JS;

$this->registerJs($js);
