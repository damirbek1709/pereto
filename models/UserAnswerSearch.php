<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserAnswer;

/**
 * UserAnswerSearch represents the model behind the search form of `app\models\UserAnswer`.
 */
class UserAnswerSearch extends UserAnswer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'test_id', 'question_id', 'answer_id'], 'integer'],
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
        $query = UserAnswer::find();

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
            'test_id' => $this->test_id,
            'question_id' => $this->question_id,
            'answer_id' => $this->answer_id,
        ]);

        return $dataProvider;
    }
}
