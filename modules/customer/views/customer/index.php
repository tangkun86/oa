<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\customer\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '客户管理';
$this->params['breadcrumbs'][] = $this->title;
$actionId = Yii::$app->requestedAction->id;

?>
<div class="customer-index">

    <p class="btn-group hidden-xs">
        <?= Html::a('客户列表', ['index'], ['class' => $actionId=='trash' ? 'btn btn-outline btn-default' : 'btn btn-primary']) ?>
        <?= Html::a('垃圾筒', ['trash'], ['class' => $actionId=='index' ? 'btn btn-outline btn-default' : 'btn btn-primary']) ?>
    </p>
    <div class="help-block m-t"></div>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'layout'=> '{items}<div class="text-right tooltip-demo">{pager}</div>',
        'pager'=>[
            //'options'=>['class'=>'hidden']//关闭自带分页
            'firstPageLabel'=>"首页",
            'prevPageLabel'=>'上一页',
            'nextPageLabel'=>'下一页',
            'lastPageLabel'=>'末页',
            'maxButtonCount' => 9,
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header' => '序号'],

            'name',

            [
                'class' => 'yii\grid\DataColumn', //由于是默认类型，可以省略
                'header' => '级别',
                'value' => function ($data) {
                    switch ($data->grade){
                        case 1:
                            return 'A';break;
                        case 2:
                            return 'B';break;
                        case 3:
                            return 'C';break;
                        case 4:
                            return 'D';break;
                    }
                    return '';
                },
            ],

            [
                'label' => '所属公司',
                'value' => 'company.name',
            ],

            [
                'class' => 'yii\grid\DataColumn', //由于是默认类型，可以省略
                'header' => '状态',
                'value' => function ($data) {
                    return $data->status==0 ? '正常' : '已作废';
                },
            ],

            [
                'class' => 'yii\grid\DataColumn', //由于是默认类型，可以省略
                'header' => '创建人／时间',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data['creator']['account'].'<br>'.$data->create_time;
                },
            ],

            [
                'class' => 'yii\grid\DataColumn', //由于是默认类型，可以省略
                'header' => '最后修改人／时间',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data['updater']['account'].'<br>'.$data->update_time;
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{update} {switch}',
                'buttons' => [
                    'switch' => function($url, $model){
                        $btn_link = '';
                        switch ($model->status){
                            case 0:
                                $btn_link = Html::a('<i class="glyphicon glyphicon-ban-circle"></i>',
                                    $url . '&status=1',
                                    [
                                        'class' => 'btn btn-xs',
                                        'data-method' => 'post',
                                        'data' => ['confirm' => '你确定要作废吗?']
                                    ]);
                                break;
                            case 1:
                                $btn_link = Html::a('<i class="glyphicon glyphicon-ok"></i>',
                                    $url . '&status=0',
                                    [
                                        'class' => 'btn btn-xs',
                                        'data-method' => 'post',
                                        'data' => ['confirm' => '你确定要恢复吗?']
                                    ]);
                                break;
                        }
                        return $btn_link;
                    },

                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    <p class="text-right">
        <?= $actionId=='index' ? Html::a('新增客户', ['create'], ['class' => 'btn btn-sm btn-primary']) : '' ?>
    </p>
</div>
