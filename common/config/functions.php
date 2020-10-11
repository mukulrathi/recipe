<?php
/**
 * Created by PhpStorm.
 * User: lubuntu
 * Date: 25/11/16
 * Time: 11:53 AM
 */
use yii\helpers\VarDumper;

function pr($e, $f = true)
{
    echo "<pre>";
    VarDumper::dump($e, 10, true);
    echo "</pre>";

    if($f){
        exit;
    }
}

