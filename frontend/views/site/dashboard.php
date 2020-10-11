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

<div class="dashboard">
    <div class="jumbotron">
        <h1>Hello, <?= $user->userProfile->getName()?>!</h1>
        <h3>Welcome to Jumbo Garage</h3>
    </div>
</div>
