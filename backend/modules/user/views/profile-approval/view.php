<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 22/4/17
 * Time: 12:43 PM
 */

use yii\bootstrap\Html;

/** @var $this \yii\web\View */
/** @var $model  \backend\modules\user\models\UserProfileApproval*/
$this->title = 'Profile Approval Request by ' . $model->user->userProfile->getName();
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="user-profile-approval-view">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>

        <div class="box-body">

        </div>
    </div>
</div>
