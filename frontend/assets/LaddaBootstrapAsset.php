<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 4/5/2019
 * Time: 3:45 PM
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class LaddaBootstrapAsset extends AssetBundle
{
    public $sourcePath = '@bower/ladda-bootstrap/dist';

    public $css = [
        'ladda-themeless.css'
    ];
    public $js = [
        'spin.js',
        'ladda.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}