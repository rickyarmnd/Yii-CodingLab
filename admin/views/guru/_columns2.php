<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\GuruMataPelajaran;

return [
    //[
        //'class' => 'kartik\grid\CheckboxColumn',
        //'width' => '20px',
    //],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama_guru',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Tambah Guru',
        'template' => '{btn_aksi}',
        'buttons' => [
            "btn_aksi" => function ($url, $model, $key) use ($id_mata_pelajaran) {    
                $getStatus =  GuruMataPelajaran::find()->where(['id_mata_pelajaran' => $id_mata_pelajaran , 'id_guru'=> $model->id ])->one();

            if($getStatus === null ){
                return Html::a('Pilih Guru', ['/guru-mata-pelajaran/pilih-guru' ,'id_mata_pelajaran' => $id_mata_pelajaran , 'id_guru' => $model->id ] , [
                    'class' => 'btn btn-primary btn-block',
                    'role'  => 'modal-remote',
                    'title' => 'Pilih',
                    'data-toggle' => 'tooltip'
                ]);
            }else{
                return Html::a('Batal Pilih', ['guru-mata-pelajaran/batal-pilih-guru' , 'id_guru' => $getStatus->id_guru , 'id_mapel' =>$getStatus->id_mata_pelajaran] , [
                    'class' => 'btn btn-danger btn-block',
                    'role'  => 'modal-remote',
                    'title' => 'Pilih',
                    'data-toggle' => 'tooltip'
                ]);
            }   
            },

        ]
    ],
    
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'id_user',
    // ],
    // [
    //     'class' => 'kartik\grid\ActionColumn',
    //     'dropdown' => false,
    //     'vAlign'=>'middle',
    //     'urlCreator' => function($action, $model, $key, $index) { 
    //             return Url::to([$action, 'id' => $model->id]);
    //     },
    //     'viewOptions'=>['role'=>'modal-remote','title'=>'Lihat','data-toggle'=>'tooltip'],
    //     'updateOptions'=>['role'=>'modal-remote','title'=>'Ubah', 'data-toggle'=>'tooltip'],
    //     'deleteOptions'=>['role'=>'modal-remote','title'=>'Hapus', 
    //                       'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
    //                       'data-request-method'=>'post',
    //                       'data-toggle'=>'tooltip',
    //                       'data-confirm-title'=>'Peringatan',
    //                       'data-confirm-message'=>'Apakah anda yakin ingin menghapus data ini?'], 
    // ],

];   