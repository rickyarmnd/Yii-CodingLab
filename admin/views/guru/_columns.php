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
        'visible' => $id_mata_pelajaran == NULL ? FALSE:TRUE,
        'header' => 'Tambah Guru',
        'template' => '{btn_aksi}',
        'buttons' => [
            "btn_aksi" => function ($url, $model, $key) use ($id_mata_pelajaran) {    
                // $getStatus =  GuruMataPelajaran::find()->where(['id_mata_pelajaran' => $id_mata_pelajaran , 'id_guru'=> $model->id ])->one();

            if($model->cekStatusMataPelajaran($id_mata_pelajaran) == FALSE ){
                return Html::a('Pilih Guru', ['tambah-guru-pelajaran' ,'id_mata_pelajaran' => $id_mata_pelajaran , 'id_guru' => $model->id ] , [
                    'class' => 'btn btn-primary btn-block',
                    'role'  => 'modal-remote',
                    'title' => 'Pilih',
                    'data-toggle' => 'tooltip'
                ]);
            }else{
                return Html::a('Batal Pilih', ['tambah-guru-pelajaran' , 'id_guru' => $model->id , 'id_mata_pelajaran' =>$id_mata_pelajaran] , [
                    'class' => 'btn btn-danger btn-block',
                    'role'  => 'modal-remote',
                    'title' => 'Pilih',
                    'data-toggle' => 'tooltip'
                ]);
            }   
            },

        ]
    ],
    [
        'class'=>'\kartik\grid\ActionColumn',
        'header'=>'Akun',
        // 'visible' => $id_mata_pelajaran ?? false,
        'visible' => $id_mata_pelajaran == NULL ? TRUE:FALSE,
        'template' => '{btn_aksi}',
        'buttons' =>[
            "btn_aksi" => function($url, $model,$key){
                if ($model->id_user == 0) {
                    return Html::a('Buat Akun', ['add-akun', 'id' => $model->id], [
                        'class' => 'btn btn-success text-white btn-block',
                        'role' => 'modal-remote',
                        'title' => 'Buat Akun',
                        'data-toggle' => 'tooltip'
                    ]);
                }else{
                    return Html::a('Lihat Akun', ['view-akun', 'id' => $model->id_user], [
                        'class' => 'btn btn-primary text-white btn-block',
                        'role' => 'modal-remote',
                        'title' => 'Lihat Akun',
                        'data-toggle' => 'tooltip'
                    ]);
                }
            }
        ]
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'id_user',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'visible' => $id_mata_pelajaran = NULL ? TRUE:FALSE,
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action, 'id' => $model->id]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Lihat','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Ubah', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Hapus', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Peringatan',
                          'data-confirm-message'=>'Apakah anda yakin ingin menghapus data ini?'], 
    ],

];   