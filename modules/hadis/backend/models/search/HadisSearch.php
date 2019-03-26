<?php

namespace modules\hadis\backend\models\search;

use common\models\Hadis;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * NewsSearch represents the model behind the search form about `common\models\News`.
 */
class HadisSearch extends Hadis
{
    public $start_created_at;
    public $end_created_at;
    public $start_updated_at;
    public $end_updated_at;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'num'], 'integer'],
            [['published'], 'boolean'],
            [['text', 'created_at', 'updated_at'], 'safe'],
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
        $query = Hadis::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (isset($params['HadisSearch']['created_at']) && strstr($params['HadisSearch']['created_at'],'до')){
            list($this->start_created_at,$this->end_created_at) = explode('до', $params['HadisSearch']['created_at']);
            $this->start_created_at .= '00:00:00';
            $this->end_created_at .= ' 23:59:59';
        }
        if (isset($params['HadisSearch']['updated_at']) && strstr($params['HadisSearch']['updated_at'],'до')){
            list($this->start_updated_at,$this->end_updated_at) = explode('до', $params['HadisSearch']['updated_at']);
            $this->start_updated_at .= '00:00:00';
            $this->end_updated_at .= ' 23:59:59';
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'published' => $this->published,
            'num' => $this->num,
        ]);

        $query->andFilterWhere(['between', 'created_at',  $this->start_created_at, $this->end_created_at]);
        $query->andFilterWhere(['between', 'updated_at',  $this->start_updated_at, $this->end_updated_at]);

        $query->andFilterWhere(['like', 'LOWER(text)', mb_strtolower($this->text, 'UTF-8')]);

        return $dataProvider;
    }
}
