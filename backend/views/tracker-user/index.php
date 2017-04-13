<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TrackerUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tracker Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tracker-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tracker User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ip',
            'phone',
            'created_at',
            'updated_at',
            // 'number',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
