<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 22/4/17
 * Time: 12:33 PM
 */

namespace backend\modules\user\models\search;

use backend\modules\user\models\UserProfileApproval;
use backend\modules\user\models\UserProfileApprovalStatus;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class UserProfileApprovalSearch extends UserProfileApproval
{
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = UserProfileApproval::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->user_id,
            'status' => $this->status,
        ]);

        $query->orderBy(new Expression("FIELD(status, " . implode(',', UserProfileApprovalStatus::getConstantsByName()) . "), updated_at DESC"));

        return $dataProvider;
    }
}