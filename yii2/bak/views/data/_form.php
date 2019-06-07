<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User; 
use dosamigos\datetimepicker\DateTimePicker;
use kartik\time\TimePicker;
use app\models\Daftarruangan;
/* @var $this yii\web\View */
/* @var $model app\models\Data */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <?= $form->field($model, 'user_id')->textInput(['readonly'=>true,'value' => Yii::$app->user->identity->id]) ?>
    
    <!-- <?= $form->field($model, 'start_time')->textInput() ?> -->
    <?= $form->field($model, 'start_time')->widget(
    DateTimePicker::className(),[
        'inline' =>false,
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii',
            // 'format' => 'dd MM yyyy - HH:ii ',
        ]
    ]);?>

        <!-- <?= $form->field($model, 'end_time')->textInput() ?> -->
    <?= $form->field($model, 'end_time')->widget(
    DateTimePicker::className(),[
        'inline' =>false,
        'clientOptions' => [
            'autoclose' => true,
             'format' => 'yyyy-mm-dd hh:ii',
            // 'format' => 'dd MM yyyy - HH:ii ',
        ]
    ]);?>



    <!-- <?= $form->field($model, 'ruangan_id')->textInput() ?> -->
    <div class="form-group">
            <?= Html::activeLabel($model,'ruangan_id',['class'=>'label-control'])?>
            <?= Html::activeDropDownList($model,'ruangan_id',ArrayHelper::map(Daftarruangan::find()->all(),'ruangan_id','ruangan_name'),['class'=>'form-control'])?>
    </div>

    <!-- <?= $form->field($model, 'user_id')->textInput() ?> -->
    

    <!-- <?= $form->field($model, 'status')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
