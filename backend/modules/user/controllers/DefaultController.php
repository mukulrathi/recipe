<?php

namespace backend\modules\user\controllers;

use backend\modules\user\models\UserAddress;
use backend\modules\user\models\UserNotification;
use backend\modules\user\models\UserProfile;
use backend\modules\user\models\UserShopAddress;
use backend\modules\user\models\UserShopDetails;
use backend\modules\user\models\UserShopServices;
use backend\modules\user\models\UserShopWorkDays;
use backend\modules\user\models\UserStatus;
use backend\modules\user\models\UserVerification;
use Yii;
use backend\modules\user\models\User;
use backend\modules\user\models\search\User as UserSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for User model.
 */
class DefaultController extends Controller
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
                    'delete' => ['POST'],
                    'mark-email-verified' => ['POST'],
                    'block-user' => ['POST'],
                    'unblock-user' => ['POST'],
                    'suspend-user' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @param null $role
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $dataProvider = new ActiveDataProvider([
            'query' => $model->getUserProfileApprovals(),
            'sort' => false
        ]);

        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $modelProfile = new UserProfile();
        $modelshopaddress = new UserShopAddress();
        $modelshopdetails = new UserShopDetails();
        $modelShopServices = new UserShopServices();
        $modelShopDays = new UserShopWorkDays();


        if ($model->load(Yii::$app->request->post()) &&
            $modelProfile->load(Yii::$app->request->post()) &&
            $modelshopaddress->load(Yii::$app->request->post()) &&
            $modelshopdetails->load(Yii::$app->request->post()) &&
            $modelShopServices->load(Yii::$app->request->post()) &&
            $modelShopDays->load(Yii::$app->request->post())

        ) {
            $model->generateAuthKey();

            $valid = $model->validate();
            $valid = $valid && $modelProfile->validate();
            $valid = $valid && $modelshopaddress->validate();
            $valid = $valid && $modelshopdetails->validate();
            $valid = $valid && $modelShopServices->validate();
            $valid = $valid && $modelShopDays->validate();

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {

                    $model->setPassword($model->password_hash);
                    if ($flag = $model->save(false)) {
                        $this->assignRole($model, 'owner');
                        $modelProfile->user_id = $model->id;
                        $modelProfile->save(false);
                        /*
                         * Address
                         */
                        $modelshopaddress->user_id = $model->id;
                        $modelshopaddress->save(false);


                        $modelshopdetails->user_id = $model->id;
                        $modelshopdetails->save(false);


                        /*
                         * Services
                         */
                        foreach ($modelShopServices->service_id as $result):
                            $modelShopServices = new UserShopServices();
                            $modelShopServices->user_id = $model->id;
                            $modelShopServices->service_id = $result;
                            $modelShopServices->save(false);

                        endforeach;
                        /*
                         *  Days
                         */
                        foreach ($modelShopDays->days as $result):
                            $modelShopServices = new UserShopWorkDays();
                            $modelShopServices->user_id = $model->id;
                            $modelShopServices->days = $result;
                            $modelShopServices->save(false);
                        endforeach;

                    }

                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'User has been created successfully.');
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (\Exception $exception) {
                    pr($exception->getMessage());
                    Yii::$app->session->setFlash('error', 'Unable to create user.');
                    $transaction->rollBack();
                }
            } else {
                pr($modelShopServices->errors);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'modelProfile' => $modelProfile,
            'modelshopaddress' => $modelshopaddress,
            'modelshopdetails' => $modelshopdetails,
            'modelShopServices' => $modelShopServices,
            'modelShopDays' => $modelShopDays,

        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelProfile = $model->userProfile;
        $modelshopaddress = $model->userShopAddress;
        $modelshopdetails = $model->userShopDetails;
        $modelShopDays = new UserShopWorkDays();
        $modelShopServices= new UserShopServices();
        $modelShopDays->days = ArrayHelper::getColumn($model->userShopWorkDays, 'days');
        $modelShopServices->service_id = ArrayHelper::getColumn($model->userShopServices, 'service_id');

        $model->password_hash = "";

        if ($model->load(Yii::$app->request->post()) &&
            $modelProfile->load(Yii::$app->request->post()) &&
            $modelshopaddress->load(Yii::$app->request->post()) &&
            $modelshopdetails->load(Yii::$app->request->post()) &&
            $modelShopServices->load(Yii::$app->request->post()) &&
            $modelShopDays->load(Yii::$app->request->post())

        ) {
            $valid = $model->validate();
            $valid = $valid && $modelProfile->validate();
            $valid = $valid && $modelshopaddress->validate();
            $valid = $valid && $modelshopdetails->validate();
            $valid = $valid && $modelShopServices->validate();
            $valid = $valid && $modelShopDays->validate();

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $user_attributes = ['email', 'status'];
                    if (!empty($model->password_hash)) {
                        $model->setPassword($model->password_hash);
                        $user_attributes[] = 'password_hash';
                    }
                    $model->update(false, $user_attributes);

                    if ($modelProfile->isNewRecord) {
                        $modelProfile->user_id = $model->id;
                        $modelProfile->save(false, ['first_name', 'last_name', 'user_id']);
                    } else {
                        $modelProfile->update(false, ['first_name', 'last_name', 'user_id']);
                    }

                    if(!empty($modelShopDays->days)){
                        UserShopWorkDays::deleteAll(['user_id'=>$id]);
                        foreach ($modelShopDays->days as $result):
                            $modelDays = new UserShopWorkDays();
                            $modelDays->user_id = $id;
                            $modelDays->days = $result;
                            $modelDays->save(false);
                        endforeach;

                    }

                    if(!empty($modelShopServices->service_id)){
                        UserShopServices::deleteAll(['user_id'=>$id]);
                        foreach ($modelShopServices->service_id as $result):
                            $modelDays = new UserShopServices();
                            $modelDays->user_id = $id;
                            $modelDays->service_id = $result;
                            $modelDays->save(false);
                        endforeach;

                    }

                    $modelshopaddress->user_id = $model->id;
                    $modelshopaddress->save(false);


                    $modelshopdetails->user_id = $model->id;
                    $modelshopdetails->save(false);



                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'User details has been updated successfully.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } catch (\Exception $exception) {
                    pr($exception->getMessage());
                    Yii::$app->session->setFlash('error', 'Unable to update user details.1');
                    $transaction->rollBack();
                }
            } else {
                Yii::$app->session->setFlash('error', 'Unable to update user details.a');
            }
        }
        return $this->render('update', [
            'model' => $model,
            'modelProfile' => $modelProfile,
            'modelshopaddress' => $modelshopaddress,
            'modelshopdetails' => $modelshopdetails,
            'modelShopServices' => $modelShopServices,
            'modelShopDays' => $modelShopDays,

        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionDelete($id)
    {
        if ($id == 1) {
            throw new ForbiddenHttpException('Admin Account cannot be deleted.');
        }
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', 'User has been deleted successfully.');
        return $this->redirect(['index']);
    }

    public function actionBlockUser($id)
    {
        $model = $this->findModel($id);
        if ($model->getUserRole()->name == "admin") {
            Yii::$app->session->setFlash('error', 'Admin account can\'t be blocked.');
            return $this->redirect(['index']);
        }
        $model->status = UserStatus::BLOCKED;
        $model->update(false);
        Yii::$app->session->setFlash('success', 'User has been blocked successfully.');
        return $this->redirect(['index']);
    }

    public function actionUnblockUser($id)
    {
        $model = $this->findModel($id);
        $model->status = UserStatus::ACTIVE;
        $model->update(false);
        Yii::$app->session->setFlash('success', 'User has been activated successfully.');
        return $this->redirect(['index']);
    }

    public function actionSuspendUser($id)
    {
        $model = $this->findModel($id);
        if ($model->getUserRole()->name == "admin") {
            Yii::$app->session->setFlash('error', 'Admin account can\'t be suspended.');
            return $this->redirect(['index']);
        }
        $model->status = UserStatus::SUSPENDED;
        $model->update(false);
        Yii::$app->session->setFlash('success', 'User account has been suspended successfully.');
        return $this->redirect(['index']);
    }

    public function actionDeleteMultiple()
    {
        $pk = Yii::$app->request->post('pk'); // Array or selected records primary keys
        // Preventing extra unnecessary query
        if (!$pk) {
            return;
        }
        if (($key = array_search(1, $pk)) !== false) {
            unset($pk[$key]);
        }
        Yii::$app->session->setFlash('success', 'Users has been deleted successfully.');
        return User::deleteAll(['id' => $pk]);
    }

    public function actionResendVerificationToken($id)
    {
        $model = $this->findModel($id);

        if (!$model->userVerification) {
            $modelVerification = new UserVerification();
            $modelVerification->user_id = $model->id;
        } else {
            $modelVerification = $model->userVerification;
        }

        $modelVerification->token = $modelVerification->generateUniqueRandomString('token');
        $modelVerification->request_time = date('Y-m-d H:i:s');
        $modelVerification->save(false);

        Yii::$app->emailtemplates->sendMail([
            $model->email => $model->userProfile->getName()
        ], 'email-verification', [
            'full_name' => $model->userProfile->getName(),
            'link' => Yii::$app->urlManagerFrontEnd->createAbsoluteUrl(['site/email-verification', 'token' => $modelVerification->token])
        ]);

        Yii::$app->session->setFlash('success', 'Verification Token has been sent successfully.');
        return $this->redirect(['index']);
    }

    public function actionMarkEmailVerified($id)
    {
        $model = $this->findModel($id);
        if (!$model->userVerification) {
            $modelVerification = new UserVerification();
            $modelVerification->user_id = $model->id;
            $modelVerification->token = $modelVerification->generateUniqueRandomString(32);
            $modelVerification->responded = 1;
            $modelVerification->request_time = date('Y-m-d H:i:s');
            $modelVerification->save(false);

            Yii::$app->session->setFlash('success', 'User email has been marked verified successfully.');
            return $this->redirect(['index']);
        }
        $model->userVerification->responded = 1;
        $model->userVerification->update(false);
        Yii::$app->session->setFlash('success', 'User email has been marked verified successfully.');
        return $this->redirect(['index']);
    }

    protected function assignRole($user, $role_name)
    {
        $manager = Yii::$app->authManager;
        $role = $manager->getRole($role_name);
        $role = $role ?: $manager->getPermission($role_name);
        $manager->assign($role, $user->id);
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

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
