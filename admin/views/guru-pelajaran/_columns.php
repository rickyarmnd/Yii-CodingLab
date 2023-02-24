<?php
use yii\helpers\Url;
use yii\helpers\Html;

return [
    //[
        //'class' => 'kartik\grid\CheckboxColumn',
        //'width' => '20px',
    //],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Nama Guru',
        'attribute'=>'id_guru',
        'value' => function($model){
            return $model->namaGuru->nama_guru;
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Hapus Guru',
        'template' => '{Hapus}',
        'buttons' => [
            "Hapus" => function ($url, $model, $key) {
                return Html::a('Hapus', ['delete' , 'id_guru'=> $model->id_guru ,'id_mata_pelajaran' => $model->id_mata_pelajaran ] , [
                    'class' => 'btn btn-danger btn-block',
                    'data-method'=>'POST',
                    // 'role'  => 'modal-remote',
                    'title' => 'Hapus',
                    'data-toggle' => 'tooltip'
                ]);
            },

        ]
        ],

];   