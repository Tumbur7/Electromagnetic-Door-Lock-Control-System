<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DaftarruanganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Ruangan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daftarruangan-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Daftar Ruangan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ruangan_id',
            'ruangan_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
