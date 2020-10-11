<?php
namespace backend\controllers;

use backend\models\SocialAuthConfiguration;
use backend\modules\user\models\User;
use common\models\ChangePasswordForm;
use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use common\models\PasswordResetRequestForm;
use common\models\ResetPasswordForm;
use backend\models\SiteConfiguration;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class SiteController extends Controller
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
            ],
            
           
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        $query_user = User::find();
        $query_seeker = clone $query_user;
        $total_users = $query_user->count();

        $authManager = Yii::$app->authManager;
        $roles = ArrayHelper::map($authManager->getRoles(), 'name', function($element) {
            return ucwords($element->name);
        });
        unset($roles['guest'], $roles['admin']);

        $count = [];
        $query_auth = $query_seeker->innerJoin('auth_assignment', 'user.id = auth_assignment.user_id');
        foreach ($roles as $role =>  $name) {
            $total_seekers = $query_auth
                ->where(['auth_assignment.item_name' => $role])->count();
            $count[] = [
                'name' => $name,
                'count' => $total_seekers
            ];
        }

        $users = new ActiveDataProvider([
            'query' => $query_user->limit(10)->orderBy('created_at DESC'),
            'pagination' => false,
            'sort' => false
        ]);

        return $this->render('index', [
            'total_users' => $total_users,
            'count' => $count,
            'users' => $users,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = '@app/views/layouts/main-login';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionChangePassword()
    {
        if(Yii::$app->getUser()->getIsGuest()) {
            return $this->redirect('/site/login');
        }
        /** @var $user User*/
        $user = Yii::$app->user->identity;
        $model = new ChangePasswordForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user->setPassword($_POST['ChangePasswordForm']['new_password']);
            $user->update();
            Yii::$app->session->setFlash('success', 'Your password has been changed successfully.');
            return $this->redirect(['/site/dashboard']);
        }

        return $this->render('change-password', [
            'model' => $model
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = '@app/views/layouts/main-login';
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
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
    public function actionResetPassword($token)
    {
        $this->layout = '@app/views/layouts/main-login';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Password has been updated successfully.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
