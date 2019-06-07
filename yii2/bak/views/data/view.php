<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Data */

$this->title = $model->user->username;
// $this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->data_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->data_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'data_id',
            [
                'attribute' => 'user.username',
                'label' => 'username'
            ],
            'start_time',
            'end_time',
            'ruangan_id',
            // [
            //     'attribute' => 'ruangan_id',
            //     'value' => $model->daftarruangan->ruangan_name,
            // ],

            'user_id',
            'status',
        ],
    ]) ?>

</div>
