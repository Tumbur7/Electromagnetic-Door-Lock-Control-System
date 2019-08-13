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
    <?php foreach ($dataProvider as $data) {?>
      <div class="site-index">
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3><?= $data['ruangan_name'] ?></h3>
                  
                <p>Status : <?= $data['status'] ?></p>
                
                
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info<i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
      </div>  
   
    <?php } ?>
    
</div>

