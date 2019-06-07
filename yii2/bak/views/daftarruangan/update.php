<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Daftarruangan */

$this->title = 'Update Daftarruangan';
$this->params['breadcrumbs'][] = ['label' => 'Daftarruangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ruangan_id, 'url' => ['view', 'id' => $model->ruangan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="daftarruangan-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
