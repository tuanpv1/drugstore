<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Subcriber */

$this->title = 'Cập nhật khách hàng ' . $model->phone;
$this->params['breadcrumbs'][] = ['label' => 'QL Khách hàng', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->phone, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-gift"></i><?=$this->title?></div>
            </div>
            <div class="portlet-body form">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>