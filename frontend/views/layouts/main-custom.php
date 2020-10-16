<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

use frontend\assets\CustomAsset;
CustomAsset::register($this);
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
    <title><?= isset($this->title) ? Html::encode($this->title) . ' | ' .'Jumbo Garage' : 'Jumbo Garage' ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= \frontend\components\GrowlAlertWidget::widget() ?>
<?= $content ?>
<?= $this->render('modal')?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
