<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'QL Đơn hàng';
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
            <div class="portlet-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'pjax' => true,
                    'filterModel' => $searchModel,
                    'columns' => [
//                        ['class' => 'kartik\grid\SerialColumn'],

                        'id',
                        'phone',
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'id_sub',
                            'format' => 'raw',
                            'value' => function ($model, $key, $index, $widget) {
                                return \common\models\Subcriber::findOne($model->id_sub)->name;
                            },
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'total',
                            'format' => 'raw',
                            'value' => function ($model, $key, $index, $widget) {
                                return \common\models\Product::formatNumber($model->total).' VND';
                            },
                        ],
                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'status',
                            'width' => '200px',
                            'refreshGrid' => true,
                            'value' => function ($model, $key, $index, $widget) {
                                /** @var $model \common\models\ContentFeedback */

                                return $model->getStatusName();
                            },
                            'editableOptions' => function ($model, $key, $index) {
                                return [
                                    'header' => 'Trạng thái',
                                    'size' => 'md',
                                    'displayValueConfig' => \common\models\Order::getListStatus(),
                                    'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                                    'data' => \common\models\Order::getListStatus(),
                                    'placement' => \kartik\popover\PopoverX::ALIGN_LEFT
                                ];
                            },
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => \common\models\Order::getListStatus(),
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => 'Tất cả'],
                        ],
                        ['class' => 'yii\grid\ActionColumn',
                            'template' => '{view}',
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::toRoute(['order/view', 'id' => $model->id]), [
                                        'title' => 'Thông tin user',
                                    ]);

                                },
                            ]
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>