<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;

$this->title = 'Signup';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="daftar-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <!-- <p>Buat Akun </p> -->
    <div class="row">
        <div class="col-lg-10">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['readonly' => true , 'value'=>$namaGuru->nama_guru]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
