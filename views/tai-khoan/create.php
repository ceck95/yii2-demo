<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaiKhoan */

$this->title = 'Create Tai Khoan';
$this->params['breadcrumbs'][] = ['label' => 'Tai Khoans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tai-khoan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
