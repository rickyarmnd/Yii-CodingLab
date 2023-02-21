<?php

use yii\bootstrap4\Modal;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;


?>

<div class="kelas-view">
    <h3>Nama Kelas : <?= $nama_kelas ?></h3>
        <?php $form = ActiveForm::begin(); ?>  
        <?= $form->field($model, 'id_kelas')->hiddenInput(['value'=>$id_kelas])->label(false); ?>  
        <?php $listSiswa = ArrayHelper::map($listSiswa, 'id', 'nama' ); ?>
        <?= $form->field($model, 'id')->widget(Select2::className(),
        [
            'data' => $listSiswa,
            'options' => [
                'placeholder' => 'Pilih Siswa',
                'multiple' => true
            ],
                'pluginOptions' => [
                ],
        ])->label('Siswa'); 
        ?>
        <?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Tambah Siswa' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' , 'role'  => 'modal-remote',
                    ]) ?>
	    </div>
    	<?php } ?>            
        <?php ActiveForm::end(); ?>
    </div>
    <div class="list-siswa">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>    
                <td><b>Nama</b></td>
            </tr>
            <?php foreach ($siswa as $sw) : ?>
            <tr>
                    <td><?= $sw->nama; ?></td>
            </tr>
            <?php endforeach; ?>

    