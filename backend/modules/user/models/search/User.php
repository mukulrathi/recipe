<?php

namespace backend\modules\user\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\user\models\User as UserModel;

/**
 * User represents the model behind the search form about `backend\modules\user\models\User`.
 */
class User extends UserModel
{
    public $role;

    public $q;

    public $emailVerified;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'role', 'q'], 'safe'],
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
        $query = User::find();
        $query->joinWith(['userProfile', 'userShopAddress'], true, 'left JOIN');
        $query->leftJoin('auth_assignment', '`auth_assignment`.`user_id` = `user`.`id`');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'defaultOrder' => [
                'id' => SORT_DESC,
            ],
        ]);

        $dataProvider->sort->attributes['userProfile.name'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => [
                'user_profile.first_name' => SORT_ASC,
                'user_profile.last_name' => SORT_ASC,
            ],
            'desc' => [
                'user_profile.first_name' => SORT_DESC,
                'user_profile.last_name' => SORT_DESC,
            ]
        ];

        $dataProvider->sort->attributes['emailVerified'] = [
            'asc' => [
                'user_verification.responded' => SORT_DESC
            ],
            'desc' => [
                'user_verification.responded' => SORT_ASC,
            ]
        ];

        $dataProvider->sort->attributes['profileApproved'] = [
            'asc' => [
                'user_profile.is_profile_approved' => SORT_DESC
            ],
            'desc' => [
                'user_profile.is_profile_approved' => SORT_ASC,
            ]
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'item_name' => $this->role,
            'status' => $this->status,
            'responded' => $this->emailVerified,
        ]);

        $query->andFilterWhere([
            'or',
            ['like', 'username', $this->q],
            ['like', 'email', $this->q],
            ['like', 'user_profile.first_name', $this->q],
            ['like', 'user_profile.last_name', $this->q],
        ]);

        return $dataProvider;
    }
}
