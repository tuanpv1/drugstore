<?php

use common\models\Post;
use common\widgets\CKEditor;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
$avatarPreview = !$model->isNewRecord && !empty($model->image);
$_SESSION['KCFINDER'] = ['disabled' => false];
?>

<div class="form-body">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fullSpan' => 8,
//        'enableAjaxValidation' => true,
//        'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->widget(\kartik\file\FileInput::classname(), [
        'pluginOptions' => [

            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' => 'Chọn hình ảnh đại diện bài viết',
            'initialPreview' => $avatarPreview ? [
                Html::img(Yii::getAlias('@web') . '/' . Yii::getAlias('@image_post') . "/" . $model->image, ['class' => 'file-preview-image', 'style' => 'width: 100%;']),

            ] : [],
        ],
        'options' => [
            'accept' => 'image/*',
        ],
    ]);
    ?>

    <?= $form->field($model, 'short_des')->textarea(['maxlength' => 255]) ?>

    <?= $form->field($model, 'des')->widget(CKEditor::className(), [
        'options' => [
            'rows' => 6,
        ],
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList(['Chọn trạng thái'=>Post::getListStatus()]) ?>

    <div class="row text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Hủy', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
