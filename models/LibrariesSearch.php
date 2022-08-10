<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Libraries;

/**
 * LibrariesSearch represents the model behind the search form of `app\models\Libraries`.
 */
class LibrariesSearch extends Libraries
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'description', 'text', 'title_ky', 'description_ky', 'text_ky', 'title_en', 'text_en', 'description_en'], 'safe'],
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
        $query = Libraries::find();
        //$query->joinWith('bridge');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
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
            //'tag.id'=>$this->tag->id
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'title_ky', $this->title_ky])
            ->andFilterWhere(['like', 'description_ky', $this->description_ky])
            ->andFilterWhere(['like', 'text_ky', $this->text_ky])
            ->andFilterWhere(['like', 'title_en', $this->title_en])
            ->andFilterWhere(['like', 'text_en', $this->text_en])
            ->andFilterWhere(['like', 'description_en', $this->description_en])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'photo_crop', $this->photo_crop])
            ->andFilterWhere(['like', 'photo_cropped', $this->photo_cropped]);

        return $dataProvider;
    }
}
