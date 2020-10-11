<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 22/2/18
 * Time: 4:46 PM
 */

namespace frontend\components;


use yii\base\Application;
use yii\base\BootstrapInterface;

class ApplicationSettingComponent implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $app->name = 'Radical IIT';
    }
}