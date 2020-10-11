<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' .Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li>
                    <a href="<?= Yii::$app->urlManagerFrontEnd->createUrl(['site/index'])?>" target="_blank"><i class="fa fa-home fa-lg" aria-hidden="true"></i></a>
                </li>

                <!-- Messages: style can be found in dropdown.less-->
                <?= $this->render('partials/_messages', [
                    'directoryAsset' => $directoryAsset
                ])?>

                <?= $this->render('partials/_notification', [
                    'directoryAsset' => $directoryAsset
                ])?>

                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        
                        <span class="hidden-xs"><?= Yii::$app->user->identity->userProfile->getName()?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><?= Html::a(
                                'Update Profile',
                                ['/user/default/update', 'id' => Yii::$app->user->identity->getId()]
                            ) ?></li>
                        <li>
                            <?= Html::a(
                                'Change Password',
                                ['/site/change-password']
                            ) ?>
                        </li>
                        <li>
                            <?= Html::a(
                                'Sign out',
                                ['/site/logout'],
                                ['data-method' => 'post']
                            ) ?>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
