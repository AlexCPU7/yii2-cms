<?php

namespace common\modules\content\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\content\models\Content;

/**
 * ContentSearch represents the model behind the search form of `common\modules\content\models\Content`.
 */
class ContentSearch extends Content
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'user_id', 'active'], 'integer'],
            [['title', 'sub_title', 'img', 'decsr', 'link', 'title_anons', 'sub_title_anons', 'img_anons', 'decsr_anons', 'link_anons', 'create_tm', 'update_tm'], 'safe'],
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
        $query = Content::find()
            ->where(['type_id' => $params['type']])
            ->andWhere(['active' => 1]);

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
            'type_id' => $this->type_id,
            'user_id' => $this->user_id,
            'active' => $this->active,
            'create_tm' => $this->create_tm,
            'update_tm' => $this->update_tm,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'sub_title', $this->sub_title])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'decsr', $this->decsr])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'title_anons', $this->title_anons])
            ->andFilterWhere(['like', 'sub_title_anons', $this->sub_title_anons])
            ->andFilterWhere(['like', 'img_anons', $this->img_anons])
            ->andFilterWhere(['like', 'decsr_anons', $this->decsr_anons])
            ->andFilterWhere(['like', 'link_anons', $this->link_anons]);

        return $dataProvider;
    }
}
