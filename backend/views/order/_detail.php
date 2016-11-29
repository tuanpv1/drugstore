<?php
use common\models\Order;
use common\models\Product;
use common\models\User;
use kartik\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

?>
<div class="tabbable-custom ">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'id_sub',
                    'value' => \common\models\Subcriber::findOne($model->id_sub)->name,
                ],
                'phone',
                'address',
                [
                    'attribute' => 'total',
                    'value' => \common\models\Product::formatNumber($model->total).' VND',
                ],
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => \common\models\Order::getStatus($model->status)
                ],
                [
                    'attribute' => 'id_user',
                    'value' => $model->id_user?\common\models\User::findOne($model->id_user)->username:'Khách hàng tự đặt trên FE',
                ],
                [                      // the owner name of the model
                    'attribute' => 'created_at',
                    'label' => 'Ngày tạo',
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