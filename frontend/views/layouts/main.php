<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
AppAsset::register($this);
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Recipe</title>
    <?php $this->head() ?>
</head>
<body class="right-column-fixed">
<?php $this->beginBody() ?>
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<div class="wrapper">
    <?= $this->render('header') ?>
    <?= $content ?>
    <?= $this->render('modal') ?>
    <?= $this->render('footer') ?>
    
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
