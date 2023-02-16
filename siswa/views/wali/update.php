<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model siswa\models\Wali */
?>
<div class="wali-update">

    <?= $this->render('_form', [
        'model' => $model,
        'statusWali' => $statusWali,
        // 'data' => $data,
    ]) ?>

</div>
