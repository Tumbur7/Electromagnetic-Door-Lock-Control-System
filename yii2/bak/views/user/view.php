<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?php 
            if(yii::$app->user->identity->role_id===1){ 
        ?>

        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

        <?php 
            }
            else{
                 
        ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?> 
        <?php } ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'username',
            // 'password',
            // 'acces_token',
            // 'auth_key',
            'fullname',
            // 'role_id',
            [
                'attribute' => 'role_id',
                'value' => $model->role->access_page,
            ],
        ],
    ]) ?>

</div>
