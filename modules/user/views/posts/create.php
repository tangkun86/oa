<?php

//use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Posts */

$this->title = '新增岗位';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
