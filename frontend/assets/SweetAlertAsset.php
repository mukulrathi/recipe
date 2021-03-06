<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/9/2019
 * Time: 3:42 PM
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class SweetAlertAsset extends AssetBundle
{
    public $js = [
        // 'https://unpkg.com/sweetalert@2.0.8/dist/sweetalert.min.js'
        'https://cdn.jsdelivr.net/npm/sweetalert2@8'
    ];

    public $css = [
        // 'https://unpkg.com/sweetalert@2.0.8/dist/sweetalert.min.js'
        'https://cdn.jsdelivr.net/npm/sweetalert2@8.18.1/dist/sweetalert2.min.css'
    ];



    public $depends = [
        'yii\web\YiiAsset',
    ];
}