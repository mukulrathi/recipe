<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 1/11/17
 * Time: 10:07 AM
 */

namespace backend\models;

use Yii;
use yii\base\Model;

class SocialAuthConfiguration extends Model
{
    /**
     * @var boolean enable social auth
     */
    public $enableSocialAuth;

    /**
     * @var boolean enable facebook auth
     */
    public $enableFacebookAuth;

    /**
     * @var boolean enable google plus auth
     */
    public $enableGooglePlusAuth;

    /**
     * @var boolean enable twitter auth
     */
//    public $enableTwitterAuth;

    /**
     * @var string facebook client id
     */
    public $facebookClientId;

    /**
     * @var string facebook client secret
     */
    public $facebookClientSecret;

    /**
     * @var string facebook client id
     */
    public $googlePlusClientId;

    /**
     * @var string google plus client secret
     */
    public $googlePlusClientSecret;

    /**
     * @var string twitter client id
     */
//    public $twitterClientId;

    /**
     * @var string twitter client secret
     */
//    public $twitterClientSecret;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enableSocialAuth', 'enableFacebookAuth', 'enableGooglePlusAuth', /*'enableTwitterAuth'*/], 'boolean', 'trueValue' => true, 'falseValue' => false],
            [[
                'facebookClientId',
                'facebookClientSecret',
                'googlePlusClientId',
                'googlePlusClientSecret',
//                'twitterClientId',
//                'twitterClientSecret'
            ], 'string'],
            [['facebookClientId', 'facebookClientSecret'], 'required', 'when' => function($model) {
                return $model->enableFacebookAuth;
            }, 'whenClient' => "function (attribute, value) {
                return $('#socialauthconfiguration-enablefacebookauth').is(':checked');
            }"],
            [['googlePlusClientId', 'googlePlusClientSecret'], 'required', 'when' => function($model) {
                return $model->enableGooglePlusAuth;
            }, 'whenClient' => "function (attribute, value) {
                return $('#socialauthconfiguration-enablegoogleplusauth').is(':checked');
            }"],
            /*[['twitterClientId', 'twitterClientSecret'], 'required', 'when' => function($model) {
                return $model->enableTwitterAuth;
            }, 'whenClient' => "function (attribute, value) {
                return $('#socialauthconfiguration-enabletwitterauth').is(':checked');
            }"]*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'enableSocialAuth' => Yii::t('app', 'Enable Social Auth'),
            'enableFacebookAuth' => Yii::t('app', 'Enable Facebook Auth'),
            'enableGooglePlusAuth' => Yii::t('app', 'Enable Google Plus Auth'),
            //'enableTwitterAuth' => Yii::t('app', 'Enable Twitter Auth'),
            'facebookClientId' => Yii::t('app', 'Facebook Client Id'),
            'facebookClientSecret' => Yii::t('app', 'Facebook Client Secret'),
            'googlePlusClientId' => Yii::t('app', 'Google Plus Client Id'),
            'googlePlusClientSecret' => Yii::t('app', 'Google Plus Client Secret'),
            /*'twitterClientId' => Yii::t('app', 'Twitter Client Id'),
            'twitterClientSecret' => Yii::t('app', 'Twitter Client Secret'),*/
        ];
    }
}