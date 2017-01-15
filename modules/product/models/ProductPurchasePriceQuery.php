<?php

namespace app\modules\product\models;

/**
 * This is the ActiveQuery class for [[ProductPurchasePrice]].
 *
 * @see ProductPurchasePrice
 */
class ProductPurchasePriceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ProductPurchasePrice[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProductPurchasePrice|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
