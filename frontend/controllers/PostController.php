<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 10/13/2020
 * Time: 8:26 AM
 */

namespace frontend\controllers;


use yii\web\Controller;

class PostController extends Controller
{

    public function actionIndex(){
        return $this->render('index');
    }
}