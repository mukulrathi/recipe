<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20/4/19
 * Time: 6:42 PM
 */

namespace frontend\components;


use kartik\growl\Growl;
use yii\base\Widget;
use yii\bootstrap\Html;

class GrowlAlertWidget extends Widget
{
    public function run()
    {
        foreach (\Yii::$app->session->getAllFlashes() as $message):
            echo \kartik\growl\Growl::widget([
                'type' => (!empty($message['type'])) ? $message['type'] : 'info',
                'title' => (!empty($message['title'])) ? Html::encode($message['title']) : '',
                'icon' => (!empty($message['icon'])) ? $message['icon'] : '',
                'body' => (!empty($message['message'])) ? Html::encode($message['message']) : ' ',
                'showSeparator' => isset($message['separator']) ? (bool) $message['separator'] : false,
                'delay' => isset($message['delay']) ? $message['delay'] : 0,
                'progressBarOptions' => isset($message['progressBarOptions']) ? $message['progressBarOptions'] : [],
                'pluginOptions' => [
                    'showProgressbar' => isset($message['showProgressbar']) ? $message['showProgressbar'] : false,
                    'delay' => isset($message['duration']) ? $message['duration'] : 0,
                    'placement' => [
                        'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                        'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
                    ],
                    'icon_type' => isset($message['icon_type']) ? $message['icon_type'] : ''
                ],
                'iconOptions' => isset($message['iconOptions']) ? $message['iconOptions'] : [],
                'titleOptions' => isset($message['titleOptions']) ? $message['titleOptions'] : [],
                'bodyOptions' => isset($message['bodyOptions']) ? $message['bodyOptions'] : [],
                'linkOptions' => isset($message['linkOptions']) ? $message['linkOptions'] : [],
                'options' => isset($message['options']) ? $message['options'] : [],
                'useAnimation' => isset($message['useAnimation']) ? $message['useAnimation'] : true,
                'linkUrl' => isset($message['linkUrl']) ? $message['linkUrl'] : null,
                'linkTarget' => isset($message['linkTarget']) ? $message['linkTarget'] : '_blank',
            ]);
        endforeach;
    }
}