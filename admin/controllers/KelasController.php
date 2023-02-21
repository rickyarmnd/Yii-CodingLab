<?php

namespace admin\controllers;

use Yii;
use common\models\Kelas;
use common\models\SiswaRwKelas;
use common\models\Siswa;
use common\models\RefTahunAjaran;
use common\models\RefTingkatKelas;
use common\models\Guru;
use common\models\RefJurusan;
use admin\models\KelasSearch;
use admin\models\PetaSiswa;
use admin\models\SiswaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


/**
 * KelasController implements the CRUD actions for Kelas model.
 */
class KelasController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Kelas models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new KelasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Kelas model.
     * @param integer $id
     * @return mixed
     */


    public function actionPetaSiswa($id_kelas , $nama_kelas)
    {
        $request = Yii::$app->request;
        $siswa = Siswa::find()->where(['id_kelas' => $id_kelas])->all();
        $model = new Siswa();
        $listSiswa = Siswa::find()
        ->where(['!=','id_kelas',$id_kelas])
        ->all();
        $saveData = new PetaSiswa();

        $id_kelas = $id_kelas;        
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){

                return [
                    'title'=> "Kelas",
                    'content'=>$this->renderAjax('peta-siswa', [
                        'siswa' => $siswa,
                        'model' => $model,
                        'id_kelas' => $id_kelas,
                        'nama_kelas' => $nama_kelas,
                        'listSiswa' => $listSiswa,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan' , ['class' => 'btn btn-primary' ,'type'=>'submit'])
                ];    
                    }else if($request->post() && $saveData->tambahSiswaKelas($request->post())){
            
            
                    return[
                        'title' => "Daftar Siswa",
                        'content' => $this->renderAjax('peta-siswa',[
                            'model' => $model,
                            'nama_kelas' => $nama_kelas,
                            'id_kelas' => $id_kelas,
                            'listSiswa' => $listSiswa,
                            'siswa' => Siswa::find()->where(['id_kelas' => $id_kelas])->all(),


                        
                        ]),
                        'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                        Html::a('Tambah Siswa', ['peta-siswa', 'id_kelas' => $id_kelas], ['class' => 'btn btn-primary' ,'role' => 'modal-remote'])
                    ]; 
                                            }else{
                                                return [
                                                    'title'=> "Kelas",
                                                    'content'=>$this->renderAjax('peta-siswa', [
                                                        'siswa' => $siswa,
                                                        'model' => $model,
                                                        'id_kelas' => $id_kelas,
                                                        'nama_kelas' => $nama_kelas,
                                                        'listSiswa' => $listSiswa,
                                                    ]),
                                                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"])
                                                ];  
                                            }
        }else{
            if ($request->post() && $saveData->tambahSiswaKelas($request->post())) {
                return $this->redirect(['index']);
            } else {
                return $this->render('peta-siswa', [
                    'siswa' => $siswa,
                    'model' => $model,
                    'id_kelas' => $id_kelas,
                    'nama_kelas' => $nama_kelas,
                    'listSiswa' => $listSiswa,
                ]);
            }
        }
    }





    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Kelas ",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                            Html::a('Ubah',['update','id' => $id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Kelas model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

public function actionDataSiswa($id)
     {    
         $request = Yii::$app->request;
         $searchModel = new SiswaSearch();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $dataProvider->query->andFilterWhere(['id_kelas' => $id]);

         if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Kelas ",
                    'content'=>$this->renderAjax('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                            Html::a('Ubah',['update','id' => $id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('admin/siswa/index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
     }

    
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Kelas();  
        $tahunAjaran = ArrayHelper::map(RefTahunAjaran::find()->all(), 'id' , 'tahun_ajaran');
        $tingkatKelas = ArrayHelper::map(RefTingkatKelas::find()->all(),'id' ,'tingkat_kelas');
        $waliKelas = ArrayHelper::map(Guru::find()->all(), 'id' , 'nama_guru');
        $jurusan = ArrayHelper::map(RefJurusan::find()->all(), 'id' , 'jurusan');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Kelas",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'tahunAjaran' => $tahunAjaran,
                        'tingkatKelas' => $tingkatKelas,
                        'waliKelas' => $waliKelas,
                        'jurusan' => $jurusan,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah Kelas",
                    'content'=>'<span class="text-success">Create Kelas berhasil</span>',
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                            Html::a('Tambah Lagi',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Tambah Kelas",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'tahunAjaran' => $tahunAjaran,
                        'tingkatKelas' => $tingkatKelas,
                        'waliKelas' => $waliKelas,
                        'jurusan' => $jurusan,



                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'tahunAjaran' => $tahunAjaran,
                    'tingkatKelas' => $tingkatKelas,
                    'waliKelas' => $waliKelas,
                    'jurusan' => $jurusan,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing Kelas model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       
        $tahunAjaran = ArrayHelper::map(RefTahunAjaran::find()->all(), 'id' , 'tahun_ajaran');
        $tingkatKelas = ArrayHelper::map(RefTingkatKelas::find()->all(),'id' ,'tingkat_kelas');
        $waliKelas = ArrayHelper::map(Guru::find()->all(), 'id' , 'nama_guru');
        $jurusan = ArrayHelper::map(RefJurusan::find()->all(), 'id' , 'jurusan');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Ubah Kelas",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'tahunAjaran' => $tahunAjaran,
                        'tingkatKelas' => $tingkatKelas,
                        'waliKelas' => $waliKelas,
                        'jurusan' => $jurusan,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Kelas ",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'tahunAjaran' => $tahunAjaran,
                        'tingkatKelas' => $tingkatKelas,
                        'waliKelas' => $waliKelas,
                        'jurusan' => $jurusan,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                            Html::a('Ubah',['update', 'id' => $model->id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Ubah Kelas ",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'tahunAjaran' => $tahunAjaran,
                        'tingkatKelas' => $tingkatKelas,
                        'waliKelas' => $waliKelas,
                        'jurusan' => $jurusan,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Kelas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing Kelas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the Kelas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kelas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kelas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
