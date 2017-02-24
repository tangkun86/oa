<?php

namespace app\modules\customer\models;

//use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
//use app\modules\customer\models\Customer;

/**
 * CustomerSearch represents the model behind the search form about `app\modules\customer\models\Customer`.
 */
class CustomerSearch extends Customer
{

    public $search_type;

    public $search_keywords;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'grade', 'status', 'create_author_uid', 'update_author_uid'], 'integer'],
            [['name', 'remarks', 'create_time', 'update_time', 'search_type', 'search_keywords'], 'safe'],
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
        $query = Customer::find()->where([
            'customer.status'=>\Yii::$app->requestedAction->id == 'index' ? 0 : 1,
        ]);

        $query->joinWith('company')->joinWith('creator')->joinWith('updater');
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
            'grade' => $this->grade,
            'status' => $this->status,
            'create_author_uid' => $this->create_author_uid,
            'update_author_uid' => $this->update_author_uid,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $this->search_type ==1 && $query->andFilterWhere(['like', 'customer.name', $this->search_keywords]);

        return $dataProvider;
    }

}
