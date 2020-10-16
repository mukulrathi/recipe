<?php

namespace frontend\controllers;

use backend\modules\user\models\User;
use backend\modules\user\models\UserAddress;
use backend\modules\user\models\UserNotification;
use backend\modules\user\models\UserProfile;
use backend\modules\user\models\UserProfileApproval;
use backend\modules\user\models\UserProfileApprovalRequestStatus;
use backend\modules\user\models\UserProfileApprovalStatus;
use backend\modules\user\models\UserVerification;
use common\models\ChangePasswordForm;
use frontend\components\AuthHandler;
use frontend\models\UpdateProfileForm;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use common\models\PasswordResetRequestForm;
use common\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'main-custom',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    public function onAuthSuccess($client)
    {
        (new AuthHandler($client))->handle();
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */

    public function actionLogin()
    {

        $this->layout = 'main-custom';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                return $this->asJson([
                    'flag' => true,
                    'message' => 'Login Successfully',
                    'url' => Url::to(['/post/index'], true)
                ]);
            } else {

                return $this->asJson([
                    'flag' => false,
                    'type' => 'error',
                    'formName' => strtolower($model->formName()),
                    'message' => $model->errors,
                ]);
            }
        } else {
            //  $this->layout = '@app/views/layouts/main-home';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionDashboard()
    {
        return $this->render('dashboard');
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->growl->setFlash([
                    'type' => 'success',
                    'message' => 'Thank you for contacting us. We will respond to you as soon as possible.'
                ]);
            } else {
                Yii::$app->growl->setFlash([
                    'type' => 'error',
                    'message' => 'There was an error sending your message.'
                ]);
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $this->layout = 'main-custom';
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($user = $model->signup()) {
                        $backendUser = User::findOne($user->id);
                        $this->assignRole($user, 'user');
                        $this->saveProfile($user, $model);
                        $this->saveAddress($user, $model);
                        $this->saveNotification($user);
                        $userVerification = $this->saveUserVerification($user);
                        $transaction->commit();
                        Yii::$app
                            ->mailer
                            ->compose(
                                ['html' => 'verification-html', 'text' => 'verification-text'],
                                ['user' => $user->username, 'link' => Url::to(['/site/email-verification', 'token' => $userVerification->token], true)]
                            )
                            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                            ->setTo($user->email)
                            ->setSubject('Password reset for ' . Yii::$app->name)
                            ->send();
                        return $this->asJson([
                            'flag' => true,
                            'message' => 'Please verify your account via your email. You will only be able to sign in after verifying your email',
                            'url' => Url::to(['login'], true)
                        ]);


                    } else {

                        return $this->asJson([
                            'flag' => false,
                            'type' => 'client',
                            'message' => 'Unable to create your account.',
                        ]);
                    }
                } catch (\Exception $exception) {
                    pr($exception->getMessage());
                    $transaction->rollBack();
                    return $this->asJson([
                        'flag' => false,
                        'type' => 'client',
                        'message' => 'An error occurred while processing your request. Please try again.',
                    ]);
                }
            } else {
                return $this->asJson([
                    'flag' => false,
                    'type' => 'error',
                    'formName' => strtolower($model->formName()),
                    'message' => $model->errors,
                ]);
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    protected function assignRole($user, $role_name)
    {
        $manager = Yii::$app->authManager;
        $role = $manager->getRole($role_name);
        $role = $role ?: $manager->getPermission($role_name);
        $manager->assign($role, $user->id);
    }

    protected function saveProfile($user, $model)
    {
        $modelProfile = new UserProfile();
        $modelProfile->user_id = $user->id;
        $modelProfile->first_name = isset($model->first_name) ? $model->first_name : null;
        $modelProfile->last_name = isset($model->last_name) ? $model->last_name : null;

        if ($modelProfile->save(false)) {
            return true;
        }
        throw new HttpException(405, 'Error saving model modelProfile');
    }

    protected function saveAddress($user, $model)
    {
        $modelAddress = new UserAddress();
        $modelAddress->user_id = $user->id;
        if (isset($model->zip_code)) {
            $modelAddress->postal_code = $model->zip_code;
        }

        if ($modelAddress->save(false)) {
            return true;
        }
        throw new HttpException(405, 'Error saving model modelAddress');
    }

    public function saveNotification($user)
    {
        $modelNotification = new UserNotification();
        $modelNotification->user_id = $user->id;

        if ($modelNotification->save(false)) {
            return true;
        }
        throw new HttpException(405, 'Error saving model modelNotification');
    }

    public function saveUserVerification($user)
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

    public function actionUpdateProfile()
    {
        /** @var $user User */
        $user = Yii::$app->user->identity;

        $model = $this->loadUpdateProfile($user);

        if ($model->load(Yii::$app->request->post())) {

            $model->avatar = UploadedFile::getInstance($model, 'avatar');

            if ($model->validate()) {

            }
        }

        return $this->render('update-profile', [
            'user' => $user,
            'model' => $model
        ]);
    }

    protected function loadUpdateProfile(User $user)
    {
        $model = new UpdateProfileForm();
        $model->username = $user->username;
        $model->emailAddress = $user->email;
        $model->firstName = $user->userProfile->first_name;
        $model->lastName = $user->userProfile->last_name;
        $model->about = $user->userProfile->about;
        $model->mobile = $user->userProfile->mobile;
        $model->gender = $user->userProfile->gender;
        $model->address = $user->userAddress->address_line;
        $model->city = $user->userAddress->city;
        $model->state = $user->userAddress->state;
        $model->country = $user->userAddress->country;
        $model->latitude = $user->userAddress->latitude;
        $model->longitude = $user->userAddress->longitude;
        $model->postalCode = $user->userAddress->postal_code;

        return $model;
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = 'main-custom';
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {
                if ($model->sendEmail()) {
                    return $this->asJson([
                        'flag' => true,
                        'message' => 'Check your email for further instructions',
                    ]);
                } else {
                    return $this->asJson([
                        'flag' => false,
                        'message' => 'Sorry, we are unable to reset password for the provided email address.',
                    ]);
                }
            } else {
                return $this->asJson([
                    'flag' => false,
                    'type' => 'error',
                    'formName' => strtolower($model->formName()),
                    'message' => $model->errors,
                ]);
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    function actionResetPassword($token)
    {

        $this->layout = 'main-custom';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            // pr($e->getMessage());
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->resetPassword()) {
                return $this->asJson([
                    'flag' => true,
                    'message' => 'New password saved.',
                    'url' => Url::to(['login'])
                ]);
            } else {
                return $this->asJson([
                    'flag' => false,
                    'type' => 'error',
                    'formName' => strtolower($model->formName()),
                    'message' => $model->errors,
                ]);
            }
        }


        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


    public function actionChangePassword()
    {
        if (Yii::$app->getUser()->getIsGuest()) {
            return $this->redirect('/site/login');
        }
        /** @var $user User */
        $user = Yii::$app->user->identity;
        $model = new ChangePasswordForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $user->setPassword($_POST['ChangePasswordForm']['new_password']);
                $user->update();
                Yii::$app->growl->setFlash([
                    'type' => 'success',
                    'message' => 'Your password has been changed successfully.'
                ]);
                return $this->asJson([
                    'flag' => true,
                    'message' => 'Your password has been changed successfully',
                ]);
            } else {
                return $this->asJson([
                    'flag' => false,
                    'type' => 'error',
                    'formName' => strtolower($model->formName()),
                    'message' => $model->errors,
                ]);
            }

        }
        return $this->render('change-password', [
            'model' => $model
        ]);
    }

    /**
     * Email verification action
     *
     * @param $token
     * @return string|Response
     */
    public
    function actionEmailVerification($token)
    {
        $userVerification = $this->findUserVerificationByTokenModel($token);

        if ($userVerification) {
            if ($userVerification->responded == 0) {
                $userVerification->user->status = 1;
                $userVerification->user->update();
                $userVerification->responded = 1;
                $userVerification->update();

                Yii::$app->growl->setFlash([
                    'type' => 'success',
                    'message' => 'Your account has been verified successfully.'
                ]);


                return $this->redirect(['dashboard']);
            } else {


                Yii::$app->growl->setFlash([
                    'type' => 'info',
                    'message' => 'Your account has already been verified successfully.'
                ]);
                return $this->redirect(['login']);
            }
        } else {
            Yii::$app->growl->setFlash([
                'type' => 'error',
                'message' => 'Invalid verification token specified.'
            ]);
            return $this->redirect(['login']);
        }
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $token
     * @return bool | UserVerification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function findUserVerificationByTokenModel($token)
    {
        if (($model = UserVerification::findOne(['token' => $token])) !== null) {
            return $model;
        } else {
            return false;
        }
    }

    public
    function actionLinkSocialAccounts()
    {
        /** @var $user User */
        $user = Yii::$app->user->identity;

        return $this->render('link-social-accounts');
    }

    /**
     * Resend the verification token
     *
     * @return \yii\web\Response
     */
    public
    function actionResendVerificationToken()
    {
        /** @var $user \backend\modules\user\models\User */
        $user = Yii::$app->user->identity;

        $modelUserVerification = new UserVerification();
        if (!$user->userVerification) {
            $modelUserVerification->token = $modelUserVerification->generateUniqueRandomString('token');
            $modelUserVerification->request_time = date('Y-m-d H:i:s');
            $modelUserVerification->save(false);
            $userVerification = $modelUserVerification;
        } else {
            $user->userVerification->token = $modelUserVerification->generateUniqueRandomString('token');
            $user->userVerification->request_time = date('Y-m-d H:i:s');
            $user->userVerification->update(false);
            $userVerification = $user->userVerification;
        }

        $userVerification = $user->userVerification;

        Yii::$app->emailtemplates->sendMail([
            $user->email => $user->userProfile->getName()
        ], 'email-verification', [
            'full_name' => $user->userProfile->getName(),
            'link' => Url::to(['/site/email-verification', 'token' => $userVerification->token], true)
        ]);

        Yii::$app->growl->setFlash([
            'type' => 'success',
            'message' => 'We have sent a new verification token. Please check your email for further instructions.'
        ]);

        return $this->redirect(['dashboard']);
    }

    public
    function actionSubmitForApproval()
    {
        /** @var $model User */
        $model = Yii::$app->user->identity;

        $modelApproval = new UserProfileApproval();
        $modelApproval->user_id = $model->id;
        $modelApproval->status = UserProfileApprovalRequestStatus::UNDER_REVIEW;
        $modelApproval->save(false);

        $model->userProfile->is_profile_approved = UserProfileApprovalStatus::UNDER_REVIEW;
        $model->userProfile->update(false);

        Yii::$app->emailtemplates->sendMail([
            $model->email => $model->userProfile->getName()
        ], 'new-profile-approval-request', [
            'full_name' => Yii::$app->settings->get('SiteConfiguration', 'appName', Yii::$app->name),
            'user_full_name' => $model->userProfile->getName(),
            'email' => $model->email,
            'role' => implode(', ', $model->getAssignedRoles()),
            'link' => Yii::$app->urlManagerBackEnd->createAbsoluteUrl(['/user/default/view', 'id' => $model->id], true),
        ]);

        Yii::$app->growl->setFlash([
            'type' => 'success',
            'message' => 'Your profile has been submitted for approval.'
        ]);

        return $this->redirect(['dashboard']);
    }

    /**
     * This action should respond to 'robots.txt' request.
     * It will create its content "on the fly", taking in account current environment.
     */
    public
    function actionRobots()
    {
        if (!Yii::$app->settings->get('SiteConfiguration', 'enableRobots'))
            return;
        $disallow = YII_ENV_PROD ? '' : "\nDisallow: /";
        $siteMapUrl = Yii::$app->urlManager->getHostInfo() . Yii::$app->urlManager->getBaseUrl() . '/sitemap/sitemap.xml';
        $content = <<<ROBOTS
User-agent: *{$disallow}
Sitemap: {$siteMapUrl}
ROBOTS;
        $response = Yii::$app->getResponse();
        $response->format = Response::FORMAT_RAW;
        $response->getHeaders()->add('Content-Type', 'text/plain; charset=UTF-8');
        $response->content = $content;
        return $response;
    }
}
