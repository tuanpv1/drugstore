<?php

use common\models\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use common\models\Subcriber;

/* @var $this yii\web\View */
/* @var $model common\models\Subcriber */
/* @var $form yii\widgets\ActiveForm */

$status = Html::getInputId($model, 'status');
$status_order = Subcriber::STATUS_ORDER;

$js = <<<JS
    $("#$status").change(function () {
        var status = $('#$status').val();
        if(status == {$status_order}){
            $('#show_or').show();
        }else {
            $('#show_or').hide();
        }
    });
JS;
$js_default = <<<JS
    var status = $('#$status').val();
    if(status == {$status_order}){
        $('#show_or').show();
    }else {
        $('#show_or').hide();
    }
JS;

$this->registerJs($js_default, \yii\web\View::POS_READY);
$this->registerJs($js, \yii\web\View::POS_READY);
?>

<div class="form-body">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fullSpan' => 8,
//        'enableAjaxValidation' => true,
//        'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['Chọn trạng thái'=>Subcriber::getListStatus()]) ?>

    <div id="show_or">

        <?= $form->field($model, 'id_product')->widget(\kartik\widgets\Select2::classname(), [
            'data' => ArrayHelper::map(Product::find()->where(['status'=>Product::STATUS_ACTIVE])->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Chọn Thuốc'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

        <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    </div>

    <?= $form->field($model, 'state')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'note_admin')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <div class="row text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Hủy', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
