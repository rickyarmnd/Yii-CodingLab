<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Siswa */

?>
<div class="daftar-create">
    <?= $this->render('daftar-guru', [
        'model' => $model,
        'namaGuru' => $namaGuru,
        ]) ?>
</div>
