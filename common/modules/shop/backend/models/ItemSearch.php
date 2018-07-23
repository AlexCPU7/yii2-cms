<?php

namespace common\modules\shop\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\shop\models\Item;

/**
 * ItemSearch represents the model behind the search form of `common\modules\shop\models\Item`.
 */
class ItemSearch extends Item
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'active', 'sort'], 'integer'],
            [['title', 'url', 'descr', 'create_tm', 'update_tm'], 'safe'],
            [['price_rub', 'price_usd', 'price_eur'], 'number'],
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
        $query = Item::find();

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
            'category_id' => $this->category_id,
            'active' => $this->active,
            'price_rub' => $this->price_rub,
            'price_usd' => $this->price_usd,
            'price_eur' => $this->price_eur,
            'sort' => $this->sort,
            'create_tm' => $this->create_tm,
            'update_tm' => $this->update_tm,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'descr', $this->descr]);

        return $dataProvider;
    }
}
