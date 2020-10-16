<?php

namespace frontend\components;

use Yii;
use yii\base\Component;

class Alert extends Component
{
    public $key = 'growl-message';

    public function setFlash($message)
    {
        Yii::$app->getSession()->setFlash($this->key, $message);
    }
}