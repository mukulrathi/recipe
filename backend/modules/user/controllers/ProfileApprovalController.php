<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 22/4/17
 * Time: 12:31 PM
 */

namespace backend\modules\user\controllers;


use backend\modules\user\models\UserProfileApprovalRequestStatus;
use backend\modules\user\models\UserProfileApprovalStatus;
use backend\modules\user\models\UserStatus;
use Yii;
use backend\modules\user\models\forms\ProfileReviewForm;
use backend\modules\user\models\search\UserProfileApprovalSearch;
use backend\modules\user\models\User;
use backend\modules\user\models\UserProfileApproval;
use frontend\controllers\BaseController;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ProfileApprovalController extends BaseController
{
    public function actionIndex()
    {
        $searchModel = new UserProfileApprovalSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->sort = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Profile Approval Review
     *
     * @param $id
     * @return array|string
     */
    public function actionReview($id)
    {
        $modelApproval = $this->findModel($id);

        $model = new ProfileReviewForm();

        if($model->load(\Yii::$app->request->post())) {
            if(!$model->validate()) {
                \Yii::$app->response->format = Response::FORMAT_JSON;

                return [
                    'flag' => false,
                    'errors' => $model->errors
                ];
            }

            if($model->status == "approved") {
                $modelApproval->status = UserProfileApprovalRequestStatus::APPROVED;
                $modelApproval->update(false);

                $modelApproval->user->userProfile->is_profile_approved = UserProfileApprovalStatus::APPROVED;
                $modelApproval->user->userProfile->update(false);

                $modelApproval->user->status = UserStatus::ACTIVE;
                $modelApproval->user->update(false);
                $tag = 'profile-request-accepted';
                $params = [
                    'full_name' => $modelApproval->user->userProfile->getName(),
                ];
            } else {
                $modelApproval->status = UserProfileApprovalRequestStatus::REJECTED;
                $modelApproval->rejection_reason = $model->reason;
                $modelApproval->update(false);
                $modelApproval->user->userProfile->is_profile_approved = UserProfileApprovalStatus::REJECTED;
                $modelApproval->user->userProfile->update(false);
                $tag = 'profile-request-rejected';
                $params = [
                    'full_name' => $modelApproval->user->userProfile->getName(),
                    'reason' => $model->reason
                ];
            }

            Yii::$app->emailtemplates->sendMail([
                $modelApproval->user->email => $modelApproval->user->userProfile->getName()
            ], $tag, $params);

            \Yii::$app->response->format = Response::FORMAT_JSON;
            \Yii::$app->session->setFlash('success', 'User has been notified.');
            return [
                'flag' => true,
                'message' => 'User has been notified.'
            ];
        }

        return $this->renderAjax('review', [
            'model' => $model
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->redirect(['/user/default/view', 'id' => $model->user_id]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserProfileApproval the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserProfileApproval::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}