<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 20-07-2016
 * Time: 11:12
 */

namespace frontend\controllers;

use Yii;
use common\models\User;
use yii\web\Controller;
use backend\modules\user\models\User as BackendUser;

class BaseController extends Controller
{
    /**
     * Common send mail function
     *
     * @param User $user
     * @param array $params
     * @param string $template
     * @param string $subject
     * @param array $attachments
     * @return bool
     */
    public function sendMail(
        User $user,
        array $params = [],
        $template = 'simple-template-html',
        $subject = "Mail from Yii Application",
        $attachments = []
    )
    {
        $message = Yii::$app->mailer->compose($template, $params);

        $message->setFrom(Yii::$app->params['supportEmail'])
                ->setTo($user->email)
                ->setSubject($subject);

        if(!empty($attachments)) {
            foreach ($attachments as $attachment) {
                $message->attach($attachment);
            }
        }

        return $message->send();
    }

    public function getRole()
    {
        if(Yii::$app->user->isGuest) {
            return false;
        }
        $user = Yii::$app->user->identity;
        return current(\Yii::$app->authManager->getRolesByUser($user->getId()));
    }

    /**
     * Get admin user model
     *
     * @return BackendUser
     */
    public function getAdmin()
    {
        return BackendUser::findOne(1);
    }
}