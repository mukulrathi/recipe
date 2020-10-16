<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 12/5/17
 * Time: 4:04 PM
 */
/** @var $user \backend\modules\user\models\User */
/** @var $this \yii\web\View */
$this->title = 'Dashboard';
$user = Yii::$app->user->identity;
?>

<div id="content-page" class="content-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 row m-0 p-0">
                <div class="col-sm-12">
                    <div id="post-modal-data" class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <p>Hello, <?= $user->userProfile->getName()?>!</p>
                                <p>Welcome recipe byte</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

