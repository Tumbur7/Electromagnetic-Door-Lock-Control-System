<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php 
            if(yii::$app->user->identity->role_id===1){ 
    ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                 //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'data_id',
                     //'user_id',
                    [
                       'attribute' => 'user.username',
                        
                       'label' => 'username'
                    ],
                    'start_time',
                    'end_time',
                    'ruangan.ruangan_name',
                    [
                        'attribute' => 'status_request',
                        'label' => 'Status Request',
                    ],

                    // if(yii::$app->user->identity->role_id===1){ 
                    
                            ['class' => 'yii\grid\ActionColumn',
                                'header' => '',
                                'template' => '{accept} {reject}',
                                'buttons' => [
                                    'accept' => function($url, $model){
                                        if($model->status_request == "Pending"){
                                            return Html::a('<i class="fa fa-check"></i> Accept', ['data/accept', 'id' => $model->data_id],[
                                                'class' => 'btn btn-success',
                                                // 'data' => [
                                                //     'confirm' => 'Yakin?',
                                                //     'method' => 'Post',
                                                // ],
                                            ]);
                                        }else{
                                            return ' ';
                                        }
                                        
                                    },
                                    'reject' => function($url, $model){
                                        if($model->status_request == "Pending"){
                                            return Html::a('<i class="fa fa-close"></i> Reject', ['data/reject', 'id' => $model->data_id],[
                                                'class' => 'btn btn-danger',
                                                // 'data' => [
                                                //     'confirm' => 'Yakin?',
                                                //     'method' => 'Post',
                                                // ],
                                            ]);
                                        }else{
                                            return ' ';
                                        }
                                        
                                    },
                                ],

                            ],

		   'status',

                ],
            ]); ?>


         <?php
            }else{
         ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'data_id',
                    // 'user_id',
                    [
                        'attribute' => 'user.username',
                        
                        'label' => 'username'
                    ],
                    'start_time',
                    'end_time',
                    'ruangan.ruangan_name',
                    [
                        'attribute' => 'status_request',
                        'label' => 'Status Request',
                    ],
		    'status',
		    ['class' => 'yii\grid\ActionColumn',
		     'template' => '{view}',
		    ]

                    
                ],
            ]); ?>
         <?php
            }
         ?>

</div>
