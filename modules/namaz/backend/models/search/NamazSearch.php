<?php

namespace modules\namaz\backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Namaz;

/**
 * NamazSearch represents the model behind the search form about `common\models\Namaz`.
 */
class NamazSearch extends Namaz
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'day', 'month'], 'integer'],
            [['fajr', 'rasvet', 'asr', 'magrib', 'isha'], 'safe'],
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
        $query = Namaz::find();

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
            'day' => $this->day,
            'month' => $this->month,
        ]);

        $query->andFilterWhere(['like', 'fajr', $this->fajr])
            ->andFilterWhere(['like', 'rasvet', $this->rasvet])
            ->andFilterWhere(['like', 'asr', $this->asr])
            ->andFilterWhere(['like', 'magrib', $this->magrib])
            ->andFilterWhere(['like', 'isha', $this->isha]);

        return $dataProvider;
    }
}
