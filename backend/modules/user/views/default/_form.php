<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use mdm\admin\models\searchs\AuthItem;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\User */
/* @var $modelProfile backend\modules\user\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */
$authManager = Yii::$app->getAuthManager();
$roles = ArrayHelper::map($authManager->getRoles(), 'name', 'name');
unset($roles['guest']);
$status = \backend\modules\user\models\UserStatus::listData();
$service = \backend\modules\user\models\UserServices::listData();
$day = \backend\modules\user\models\UserServicesDay::listData();
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyB9CdZk3plxvoOJQEt_FT4ZOZ86rFRxTxw&libraries=places');

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (!$model->isNewRecord) { ?>
        <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
    <?php } ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">

            <?= $form->field($model, 'password_hash')->passwordInput(['disabled'=> $model->isNewRecord? false :true])->label('Password') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($modelProfile, 'mobile')->textInput(['disabled'=> $model->isNewRecord? false :true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">

            <?= $form->field($modelshopdetails, 'shopname')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($modelshopdetails, 'mobile')->textInput()->label('Shop Contact No.') ?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($modelProfile, 'first_name')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($modelProfile, 'last_name')->textInput() ?>

        </div>

    </div>


    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($modelshopaddress, 'address_line')->textInput(['id' => 'autocomplete'])->label('Address Line') ?>
            <?php echo $form->field($modelshopaddress, 'city')->hiddenInput()->label(false) ?>
            <?php echo $form->field($modelshopaddress, 'state')->hiddenInput()->label(false) ?>
            <?php echo $form->field($modelshopaddress, 'country')->hiddenInput()->label(false) ?>
            <?= $form->field($modelshopaddress, 'latitude', ['options' => ['tag' => false]])->hiddenInput()->label(false) ?>
            <?= $form->field($modelshopaddress, 'longitude', ['options' => ['tag' => false]])->hiddenInput()->label(false) ?>
        </div>
        <div class="col-sm-6">
            <?php echo $form->field($modelshopaddress, 'postal_code')->textInput() ?>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-6">
            <?= $form->field($model, 'status')->dropDownList($status, ['prompt' => 'Select Status']) ?>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-6">
            <?= $form->field($modelShopServices, 'service_id')->checkboxList($service) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($modelShopDays, 'days')->checkboxList($day) ?>
        </div>

    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add New User' : 'Update User', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js = <<<JS
    var input = ( document.getElementById('autocomplete') );
    var autocomplete_options = {
     types: ['address'],
      region:['locality'],
    componentRestrictions: {country: "IN"}
    };
    var autocomplete = new google.maps.places.Autocomplete(input, autocomplete_options);
    var autocompleteLsr = autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        console.log(place.address_components)
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }

        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        var coordinate = place.geometry.location.lat() + ',' + place.geometry.location.lng();
        var address = place.formatted_address;
        var country = '';
        var state = '';
        var city = '';
        var postal_code = '';
        var route = '';
        if (place.address_components) {
            var length = place.address_components.length;
            for(var i = 0; i < length; i++){
                if(place.address_components[i].types[0] == "route"){
                    route = place.address_components[i].long_name;
                }
                if(place.address_components[i].types[0] == "country"){
                    country = place.address_components[i].long_name;
                    country_code = place.address_components[i].short_name;
                }
                if(place.address_components[i].types[0] == "administrative_area_level_1"){
                    state = place.address_components[i].long_name;
                }
                if(place.address_components[i].types[0] == "locality"){
                    city = place.address_components[i].long_name;
                }

                if(place.address_components[i].types[0] == "postal_code"){
                    postal_code = place.address_components[i].long_name;
                }
            }
        }

        $('#usershopaddress-city').val(city);
        $('#usershopaddress-country').val(country);
        $('#usershopaddress-state').val(state);
        $('#usershopaddress-postal_code').val(postal_code);
        $('#usershopaddress-latitude').val(lat);
        $('#usershopaddress-longitude').val(lng);
    });
JS;
$this->registerJs($js);

