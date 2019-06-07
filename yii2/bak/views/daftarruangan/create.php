<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Daftarruangan */

$this->title = 'Create Daftarruangan';
$this->params['breadcrumbs'][] = ['label' => 'Daftarruangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daftarruangan-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
