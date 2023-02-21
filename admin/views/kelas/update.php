<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Kelas */
?>
<div class="kelas-update">

    <?= $this->render('_form', [
        'model' => $model,
        'tahunAjaran' => $tahunAjaran,
        'tingkatKelas' => $tingkatKelas,
        'waliKelas' => $waliKelas,
        'jurusan' => $jurusan,
    ]) ?>

</div>
