<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/responsive.css',
        'css/typography.css'
    ];
    public $js = [
        'js/owl.carousel.min.js',
        'js/jquery.magnific-popup.min.js',
        'js/custom.js',
        'js/site.js',
        'js/popper.min.js',
        'js/wow.min.js',
        'js/jquery.appear.js',
        'js/countdown.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
