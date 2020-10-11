<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 12/5/17
 * Time: 4:08 PM
 */
/** @var $this \yii\web\View */

$this->title = 'Social';
?>

<div class="link-social-accounts">
    <div class="social-login">
        <h3>Connect with social Network</h3>
        <?php $authAuthChoice = \yii\authclient\widgets\AuthChoice::begin([
            'baseAuthUrl' => ['site/auth'],
            'popupMode' => false
        ]); ?>
        <?php foreach ($authAuthChoice->getClients() as $client): ?>
            <?= $authAuthChoice->clientLink($client, '<i class="fa fa-' . $client->getName() . '"></i> Link ' . $client->getTitle(), ['class' => 'btn social-btn btn-' . $client->getName(), 'data-confirm' => 'Are you sure want to link your ' . $client->getName() . ' account?']) ?>
        <?php endforeach; ?>
        <?php \yii\authclient\widgets\AuthChoice::end(); ?>
    </div>
</div>
