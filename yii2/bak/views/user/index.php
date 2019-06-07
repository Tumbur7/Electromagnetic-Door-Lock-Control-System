<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php 
            if(yii::$app->user->identity->role_id===1){ 
        ?>


        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>

        <?php 
            }
            else{
            }      
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'username',
            // 'password',
            // 'acces_token',
            // 'auth_key',
            //'fullname',
            //'role_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
