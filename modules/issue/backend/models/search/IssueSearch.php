<?php

namespace modules\issue\backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Issue;

/**
 * IssueSearch represents the model behind the search form of `\common\models\Issue`.
 */
class IssueSearch extends Issue
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'completed'], 'integer'],
            [['email', 'user_name', 'content', 'created_at'], 'safe'],
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
        $query = Issue::find();

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
            'completed' => $this->completed,
        ]);
        if ($this->created_at) {
            $query->andFilterWhere([
                'between',
                'created_at',
                date('Y-m-d 00:00:00', strtotime($this->created_at)),
                date('Y-m-d 23:59:59', strtotime($this->created_at))
            ]);
        }

        $query->andFilterWhere(['like', 'email', strtolower($this->email)])
            ->andFilterWhere(['like', 'user_name', strtolower($this->user_name)])
            ->andFilterWhere(['like', 'content', strtolower($this->content)]);

        return $dataProvider;
    }
}
