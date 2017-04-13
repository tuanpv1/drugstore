<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TrackerUser */

$this->title = 'Create Tracker User';
$this->params['breadcrumbs'][] = ['label' => 'Tracker Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tracker-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
