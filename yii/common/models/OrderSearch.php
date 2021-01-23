<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;

/**
 * OrderSearch represents the model behind the search form of `common\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'delivery_type', 'delivery_zone', 'payment_type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'address', 'porch', 'floor', 'flat', 'phone', 'delivery_time', 'comment'], 'safe'],
            [['amount'], 'number'],
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
        $query = Order::find()->with('items');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
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
            'delivery_type' => $this->delivery_type,
            'delivery_zone' => $this->delivery_zone,
            'payment_type' => $this->payment_type,
            'amount' => $this->amount,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'porch', $this->porch])
            ->andFilterWhere(['like', 'floor', $this->floor])
            ->andFilterWhere(['like', 'flat', $this->flat])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'delivery_time', $this->delivery_time])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        $query->orderBy('created_at desc');

        return $dataProvider;
    }
}
