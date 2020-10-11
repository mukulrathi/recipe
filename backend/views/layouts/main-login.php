<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use dmstr\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" rel="stylesheet">
    <?php $this->head() ?>
    <style>
    .alert-container{margin-top: 25px;}
    </style>
</head>
<body class="login-page">

<?php $this->beginBody() ?>
	
	<div class="alert-container">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<?= Alert::widget() ?>
				</div>
			</div>
		</div>
	</div>
	

    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
