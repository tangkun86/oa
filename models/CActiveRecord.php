<?php

namespace app\models;

use yii\db\ActiveRecord;

class CActiveRecord extends ActiveRecord
{

    public function ajaxResponse($response = ['code'=>0, 'msg'=>'操作成功', 'data'=>[]])
    {
        header('Content-Type: application/json');
        exit(json_encode($response, JSON_UNESCAPED_UNICODE));
    }

    public function changeStatus($status, $condition='')
    {
        $params = ['status' => $status];
        return $this::getDb()->createCommand()->update($this::tableName(), $params, $condition)->execute();
    }
}