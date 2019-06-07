<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Role;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'acces_token')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'role_id')->textInput() ?> -->
    <div class="form-group">
        <?php 
            if(yii::$app->user->identity->role_id===1){ 
        ?>
            <?= Html::activeLabel($model,'role_id',['class'=>'label-control'])?>
            <?= Html::activeDropDownList($model,'role_id',ArrayHelper::map(Role::find()->all(),'role_id','access_page'),['class'=>'form-control'])?>
        <?php
            }
            else{
        ?>
        <?php
            }
        ?>
        <?php 
            if(yii::$app->user->identity->role_id===2){ 
        ?>
            <!-- <?= $form->field($model, 'role_id')->textInput() ?>  -->
        <?php
            }
            else{
        ?>
        <?php
            }
        ?>    
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
