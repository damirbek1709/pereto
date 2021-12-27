<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Answer;

/**
 * AnswerSearch represents the model behind the search form of `app\models\Answer`.
 */
class AnswerSearch extends Answer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'question_id'], 'integer'],
            [['title', 'title_ky', 'title_en', 'assessment_ky', 'assessment_en', 'hint', 'hint_ky', 'hint_en'], 'safe'],
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
        $query = Answer::find();

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
            'question_id' => $this->question_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_ky', $this->title_ky])
            ->andFilterWhere(['like', 'title_en', $this->title_en])
            ->andFilterWhere(['like', 'assessment_ky', $this->assessment_ky])
            ->andFilterWhere(['like', 'assessment_en', $this->assessment_en])
            ->andFilterWhere(['like', 'hint', $this->hint])
            ->andFilterWhere(['like', 'hint_ky', $this->hint_ky])
            ->andFilterWhere(['like', 'hint_en', $this->hint_en]);

        return $dataProvider;
    }
}
