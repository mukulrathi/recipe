<?php
namespace frontend\components;

use backend\modules\user\models\UserStatus;
use Yii;
use common\models\User;
use yii\web\HttpException;
use yii\helpers\ArrayHelper;
use yii\authclient\ClientInterface;
use backend\modules\user\models\UserProfile;
use backend\modules\user\models\UserAddress;
use backend\modules\user\models\UserSocialAuth;
use backend\modules\user\models\UserNotification;
use backend\modules\user\models\UserVerification;

/**
 * AuthHandler handles successful authentication via Yii auth component
 */
class AuthHandler
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function handle()
    {
        $client = $this->client;
        $mode =  Yii::$app->getRequest()->getQueryParam('mode');
        $attributes = $client->getUserAttributes();
        $serviceId = $attributes['id'];
        $serviceProvider = $client->getId();
        $serviceTitle = $client->getTitle();
        $firstname ='';
        $lastname='';
        $fullname ='';
        switch ($serviceProvider) {
            case 'facebook':
                $username = $email = $attributes['email'];
                $fullname = $attributes['name'];
                break;
            case 'google':
                $email = $attributes['emails'][0]['value'];
                if (isset($attributes['displayName'])) {
                    $fullname = $username = $attributes['displayName'];
                }
                if (isset($attributes['name']['familyName']) and isset($attributes['name']['givenName'])) {
                    $lastname = $attributes['name']['familyName'];
                    $firstname = $attributes['name']['givenName'];
                }
                break;
            case 'linkedin':
                $username = $email = $attributes['email-address'];
                $lastname = $attributes['first-name'];
                $firstname = $attributes['last-name'];
                $fullname = $firstname.' '.$lastname;
                break;
            case 'twitter':
                $username = $attributes['screen_name'];
                $fullname = $attributes['name'];
                // to do - fix social helpers
                $email = $serviceId.'@twitter.com';
                break;
        }

        $auth = UserSocialAuth::find()->where([
            'source' => (string)$serviceProvider,
            'source_id' => (string)$serviceId,
        ])->one();

        if(Yii::$app->user->isGuest) {
            if ($auth) {
                // if the user_id associated with this oauth login is registered, try to log them in
                $user_id = $auth->user_id;
                $person = new \backend\modules\user\models\User();
                $identity = $person->findIdentity($user_id);
                Yii::$app->user->login($identity);
            } else {
                // it's a new oauth id
                // first check if we know the email address
                if (isset($email) && User::find()->where(['email' => $email])->exists()) {
                    Yii::$app->growl->setFlash([
                        'type' => 'warning',
                        'duration' => 0,
                        'icon' => 'fa fa-exclamation',
                        'message' => Yii::t('app', "The email in this {client} account is already registered. Please login using your username and password first, then link to this account in your profile settings.", ['client' => $serviceTitle]),
                        'title' => 'Warning',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    Yii::$app->response->redirect(Yii::$app->urlManager->createAbsoluteUrl('site/login'));
                    return;
                } else {
                    if ($mode == 'login') {
                        // they were trying to login with an unconnected account - ask them to login normally and link after
                        Yii::$app->growl->setFlash([
                            'type' => 'warning',
                            'duration' => 0,
                            'icon' => 'fa fa-exclamation',
                            'message' => Yii::t('app', "We don't recognize the user with this email from {client}. If you wish to sign up, try again below. If you wish to link {client} to your " . Yii::$app->name . "  account, login first with your username and password. Then visit your profile settings.", ['client' => $serviceTitle]),
                            'title' => 'Warning',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        Yii::$app->response->redirect(Yii::$app->urlManager->createAbsoluteUrl('site/signup'));
                        return;
                    } else if($mode == 'signup') {
                        if (isset($username) && User::find()->where(['username' => $username])->exists()) {
                            $username.= Yii::$app->security->generateRandomString(6);
                        }
                        $password = Yii::$app->security->generateRandomString(12);
                        $user = new \backend\modules\user\models\User([
                            'username' => $username, // $attributes['login'],
                            'email' => $email,
                            'password' => $password,
                            'status' => UserStatus::ACTIVE,
                        ]);
                        $user->generateAuthKey();
                        $user->generatePasswordResetToken();
                        $transaction = $user->getDb()->beginTransaction();
                        if ($user->save()) {

                            $userProfile = new UserProfile();
                            $userProfile->user_id = $user->id;
                            $userProfile->first_name = $fullname;
                            $userProfile->last_name = " ";
                            $userProfile->save(false);

                            $auth = new UserSocialAuth([
                                'user_id' => $user->id,
                                'source' => $serviceProvider, // $client->getId(),
                                'source_id' => $serviceId, // (string)$attributes['id'],
                            ]);
                            if ($auth->save()) {
                                $this->assignRole($user, 'user');
                                $this->saveAddress($user);
                                $this->saveNotification($user);
                                $userVerification = $this->saveUserVerification($user);
                                if($this->sendMail($user, [
                                    'user' => $user,
                                    'userVerification' => $userVerification
                                ], 'email-verification-html', 'Please verify your account.')) {
                                    Yii::$app->growl->setFlash([
                                        'type' => 'success',
                                        'duration' => 0,
                                        'icon' => 'fa fa-check',
                                        'message' => 'Your account has been created successfully. Please check your email for further instructions.',
                                        'title' => 'Success',
                                        'positonY' => 'top',
                                        'positonX' => 'right'
                                    ]);
                                } else {
                                    Yii::$app->growl->setFlash([
                                        'type' => 'warning',
                                        'duration' => 0,
                                        'icon' => 'fa fa-exclamation',
                                        'message' => 'Unable to send email. Although your account has been created.',
                                        'title' => 'Success',
                                        'positonY' => 'top',
                                        'positonX' => 'right'
                                    ]);
                                }
                                $transaction->commit();
                                Yii::$app->user->login($user);
                            }
                        }
                    }
                }
            }
        } else {
            // user already logged in, link the accounts
            if (!$auth) { // add auth provider
                $auth = new UserSocialAuth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $serviceProvider,
                    'source_id' => $serviceId,
                ]);
                $auth->validate();
                $auth->save();
                $u = User::findOne(Yii::$app->user->id);
                $u->status = UserStatus::ACTIVE;
                $u->update();
                Yii::$app->growl->setFlash([
                    'type' => 'success',
                    'duration' => 0,
                    'icon' => 'fa fa-check',
                    'message' => Yii::t('app', 'Your {serviceProvider} account has been connected to your ' . Yii::$app->name . ' account. In the future you can log in with a single click of its logo.',
                        array('serviceProvider'=>$serviceTitle)),
                    'title' => 'Success',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
            }
        }
    }

    /**
     * @param User $user
     */
    private function updateUserInfo(User $user)
    {
        $attributes = $this->client->getUserAttributes();
        $github = ArrayHelper::getValue($attributes, 'login');
        $user->save();
    }

    protected function assignRole($user, $role_name)
    {
        $manager = Yii::$app->authManager;
        $role = $manager->getRole($role_name);
        $role = $role ?: $manager->getPermission($role_name);
        $manager->assign($role, $user->id);
    }

    protected function saveUserVerification($user)
    {
        $modelUserVerification = new UserVerification();
        $modelUserVerification->user_id = $user->id;
        $modelUserVerification->token = $modelUserVerification->generateUniqueRandomString('token');
        $modelUserVerification->request_time = date('Y-m-d H:i:s');
        if ($modelUserVerification->save(false)) {
            return $modelUserVerification;
        }
        throw new HttpException(405, 'Error saving model modelUserVerification');
    }

    protected function saveAddress($user)
    {
        $modelAddress = new UserAddress();
        $modelAddress->user_id = $user->id;

        if($modelAddress->save(false)) {
            return true;
        }
        throw new HttpException( 405, 'Error saving model modelAddress' );
    }

    public function saveNotification($user)
    {
        $modelNotification = new UserNotification();
        $modelNotification->user_id = $user->id;

        if($modelNotification->save(false)) {
            return true;
        }
        throw new HttpException( 405, 'Error saving model modelNotification' );
    }

    public function sendMail(
        User $user,
        array $params = [],
        $template = 'simple-template-html',
        $subject = "Mail from Yii Application"
    )
    {
        return Yii::$app->mailer->compose($template, $params)
            ->setFrom(Yii::$app->params['supportEmail'])
            ->setTo($user->email)
            ->setSubject($subject)
            ->send();
    }
}