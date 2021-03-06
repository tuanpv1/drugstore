<?php

use common\models\Product;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'QL Thuốc', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase"><?= $this->title ?></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="tabbable-custom ">
                    <p>
                        <?= Html::a('Cập nhật', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Xóa', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Bạn chắc chắn muốn xóa Thuốc '.$model->name.'?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            [
                                'label' => 'Ảnh đại diện',
                                'format' => 'html',
                                'value' => Html::img(Yii::getAlias('@web') . "/" . Yii::getAlias('@image_product') . "/" .$model->image, ['width' => '200px']),
                            ],
                            [                      // the owner name of the model
                                'attribute' => 'price',
                                'value' => Product::formatNumber($model->price).' VND'

                            ],
                            [                      // the owner name of the model
                                'attribute' => 'sale',
                                'value' => $model->sale.' %'

                            ],
                            [
                                'attribute' => 'status',
                                'label' => 'Trạng thái',
                                'format' => 'raw',
                                'value' => ($model->status == Product::STATUS_ACTIVE) ?
                                    '<span class="label label-success">' . $model->getStatusName() . '</span>' :
                                    '<span class="label label-danger">' . $model->getStatusName() . '</span>',
                            ],
                            [
                                'attribute' => 'des',
                                'format'=>'html',
                                'des:ntext',
                            ],
                            [                      // the owner name of the model
                                'attribute' => 'created_at',
                                'label' => 'Ngày tham gia',
                                'value' => date('d/m/Y H:i:s', $model->created_at),
                            ],
                            [                      // the owner name of the model
                                'attribute' => 'updated_at',
                                'label' => 'Ngày thay đổi thông tin',
                                'value' => date('d/m/Y H:i:s', $model->updated_at),
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
