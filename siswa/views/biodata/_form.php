<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Siswa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nis')->textInput([ 'readonly' => true, 'maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_lahir')->widget(DatePicker::className(),
        ['options' => ['place holder' => 'Masukkan Tanggal Lahir'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-M-yyyy',
            ]
        ]); 
        ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <!--  -->

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
