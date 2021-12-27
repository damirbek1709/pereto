<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserTest;

/**
 * UserTestSearch represents the model behind the search form of `app\models\UserTest`.
 */
class UserTestSearch extends UserTest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'buisness_type'], 'integer'],
            [['email', 'organization_name', 'date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = UserTest::find();

        // add conditions that should always apply here

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
            'id' => $this->id,
            'buisness_type' => $this->buisness_type,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'organization_name', $this->organization_name]);

        return $dataProvider;
    }
}
