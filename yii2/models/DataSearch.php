<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Data;

/**
 * DataSearch represents the model behind the search form of `app\models\Data`.
 */
class DataSearch extends Data
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_id', 'ruangan_id', 'user_id', 'status'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
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
        if(yii::$app->user->identity->role_id===1){
            $query=Data::find();
        }
        else{
            $query = Data::find()->where(['user_id'=>Yii::$app->user->id]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder'=>[
                    'start_time'=>SORT_DESC,
                ]
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
            'data_id' => $this->data_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'ruangan_id' => $this->ruangan_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
