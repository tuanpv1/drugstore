<?php

use common\models\Subcriber;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SubcriberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'QL Khách hàng ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span
                        class="caption-subject font-green-sharp bold uppercase"><?= $this->title ?> </span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <p>
                <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <div class="portlet-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'phone',
                            'format' => 'raw',
                            'value' => function ($model, $key, $index, $widget) {
                                return Html::a($model->phone, ['view', 'id' => $model->id], ['class' => 'label label-primary']);
                            },
                        ],
                        'name',
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'status',
                            'format' => 'raw',
                            'value' => function ($model, $key, $index, $widget) {
                                /**
                                 * @var $model common\models\Product
                                 */
                                return Subcriber::getStatus($model->status);

                            },
                            'filter' => Subcriber::getListStatus(),
                            'filterType' => GridView::FILTER_SELECT2,
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => "Tất cả"],
                        ],
                        'state:ntext',
                        // 'note_admin:ntext',
                        // 'address',

                        ['class' => 'yii\grid\ActionColumn',
                            'template' => '{update}',
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
