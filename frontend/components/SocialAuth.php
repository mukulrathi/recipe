<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 1/11/17
 * Time: 10:41 AM
 */

namespace frontend\components;

use Yii;
use yii\base\BootstrapInterface;

class SocialAuth implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $clients = [];
        if(Yii::$app->settings->get('SocialAuthConfiguration', 'enableSocialAuth')) {
            if(Yii::$app->settings->get('SocialAuthConfiguration', 'enableFacebookAuth')) {
                $clients['facebook'] = [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => Yii::$app->settings->get('SocialAuthConfiguration', 'facebookClientId'),
                    'clientSecret' => Yii::$app->settings->get('SocialAuthConfiguration', 'facebookClientSecret')
                ];
            }

            if(Yii::$app->settings->get('SocialAuthConfiguration', 'enableGooglePlusAuth')) {
                $clients['google'] = [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => Yii::$app->settings->get('SocialAuthConfiguration', 'googlePlusClientId'),
                    'clientSecret' => Yii::$app->settings->get('SocialAuthConfiguration', 'googlePlusClientSecret')
                ];
            }
        }

        $app->set('authClientCollection', [
            'class'      => 'yii\authclient\Collection',
            'clients'    => $clients
        ]);

    }
}