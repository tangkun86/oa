<?php

namespace app\modules\product\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductSearch represents the model behind the search form about `app\modules\product\models\Product`.
 */
class ProductSearch extends Product
{
    public $creator_account;

    public $updater_account;

    public $search_type;

    public $search_keywords;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'second_category_id', 'enable', 'status', 'create_author_uid', 'update_author_uid'], 'integer'],
            [['name','enable', 'number', 'description', 'create_time', 'update_time', 'creator_account', 'updater_account', 'search_type', 'search_keywords', 'first_category_id', 'second_category_id'], 'safe'],
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
        $query = Product::find()->where([
            'product.status'=>Yii::$app->requestedAction->id == 'index' ? 0 : 1,
        ]);

        if(Yii::$app->controller->module->id!='system'){
            $identity = (Object) Yii::$app->user->identity;
            $query->andWhere(['product.company_id'=>$identity->company_id]);
        }

        $query->joinWith('creator')->joinWith('updater')->joinWith('company')->joinWith('category');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'create_time' => SORT_DESC,
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
            'id' => $this->id,
            'product.first_category_id' => $this->first_category_id,
            'product.second_category_id' => $this->second_category_id,
            'product.enable' => $this->enable,
            'product.status' => $this->status,
            'create_author_uid' => $this->create_author_uid,
            'update_author_uid' => $this->update_author_uid,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'product.name', $this->name])
              ->andFilterWhere(['like', 'creator.account', $this->creator_account])
              ->andFilterWhere(['like', 'updater.account', $this->updater_account]);

        return $dataProvider;
    }
}
