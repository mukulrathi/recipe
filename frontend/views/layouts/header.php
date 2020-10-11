<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use frontend\assets\AppAsset;
AppAsset::register($this);
use yii\bootstrap\NavBar;

?>

 <?php
    NavBar::begin([
        'brandLabel' => 'Recipe',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => 'Welcome ' . Yii::$app->user->identity->username,
            'url' => ['#'],
            'items' => [
                ['label' => 'Update Profile', 'url' => ['/site/update-profile']],
                ['label' => 'Link Social Accounts', 'url' => ['/site/link-social-accounts']],
                ['label' => 'Change Password', 'url' => ['/site/change-password']],
                ['label' => 'Logout (' . Yii::$app->user->identity->username . ')', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']]
            ]
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
