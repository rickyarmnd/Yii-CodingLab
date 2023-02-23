<?php

namespace admin\controllers;

use Yii;
use common\models\GuruMataPelajaran;
use common\models\Guru;
use common\models\MataPelajaran;
use admin\models\GuruMataPelajaranSearch;
use admin\models\GuruSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


/**
 * GuruMataPelajaranController implements the CRUD actions for GuruMataPelajaran model.
 */
class GuruMataPelajaranController extends Controller
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
     * Lists all GuruMataPelajaran models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new GuruMataPelajaranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single GuruMataPelajaran model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id_guru)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "GuruMataPelajaran ",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id_guru),
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                            Html::a('Ubah',['update','id' => $id_guru],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id_guru),
            ]);
        }
    }

    /**
     * Creates a new GuruMataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new GuruMataPelajaran(); 
        
        $namaGuru = ArrayHelper::map(Guru::find()->all(), 'id', 'nama_guru');
        $mataPelajaran = ArrayHelper::map(MataPelajaran::find()->all(),'id', 'mata_pelajaran');
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah GuruMataPelajaran",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'namaGuru' => $namaGuru,
                        'mataPelajaran' => $mataPelajaran,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah GuruMataPelajaran",
                    'content'=>'<span class="text-success">Create GuruMataPelajaran berhasil</span>',
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                            Html::a('Tambah Lagi',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Tambah GuruMataPelajaran",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'namaGuru' => $namaGuru,
                        'mataPelajaran' => $mataPelajaran,
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
                    'namaGuru' => $namaGuru,
                    'mataPelajaran' => $mataPelajaran,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing GuruMataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionPilihGuru($id_guru, $id_mata_pelajaran){
        $model = new GuruMataPelajaran();
        $model->id_guru = $id_guru;
        $model->id_mata_pelajaran = $id_mata_pelajaran;
        $request = Yii::$app->request;
        $searchModel = new GuruSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model->save();
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Siswa ",
                    'forceReload' => '#crud-datatable-pjax',
                    'content'=>$this->renderAjax('../guru/index2', [      
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'id_mata_pelajaran' => $id_mata_pelajaran,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"])
                 ];    
        }else{
            return $this->render('../guru/index2', [
                
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'id_mata_pelajaran' => $id_mata_pelajaran,
            ]); 
        }
    
   }
    public function actionBatalPilihGuru($id_guru , $id_mapel){
        $model =  GuruMataPelajaran::find()->where(['id_mata_pelajaran' => $id_mapel , 'id_guru'=> $id_guru ])->one();
        $request = Yii::$app->request;
        $searchModel = new GuruSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model->delete();
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Siswa ",
                    'forceReload' => '#crud-datatable-pjax',
                    'content'=>$this->renderAjax('../guru/index2', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'id_mata_pelajaran' => $id_mapel,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"])
                 ];    
        }else{
            return $this->render('../guru/index2', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'id_mata_pelajaran' => $id_mapel,
            ]); 
        }
   }




    public function actionUpdate($id_guru)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id_guru);       
        $namaGuru = ArrayHelper::map(Guru::find()->all(), 'id', 'nama_guru');
        $mataPelajaran = ArrayHelper::map(MataPelajaran::find()->all(),'id', 'mata_pelajaran');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Ubah GuruMataPelajaran",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'namaGuru' => $namaGuru,
                        'mataPelajaran' => $mataPelajaran,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "GuruMataPelajaran ",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'namaGuru' => $namaGuru,
                        'mataPelajaran' => $mataPelajaran,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                            Html::a('Ubah',['update', 'id' => $model->id_guru],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Ubah GuruMataPelajaran ",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'namaGuru' => $namaGuru,
                        'mataPelajaran' => $mataPelajaran,
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
                return $this->redirect(['view', 'id' => $model->id_guru]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'namaGuru' => $namaGuru,
                    'mataPelajaran' => $mataPelajaran,
                ]);
            }
        }
    }

    /**
     * Delete an existing GuruMataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id_guru)
    {
        $request = Yii::$app->request;
        $this->findModel($id_guru)->delete();

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
     * Delete multiple existing GuruMataPelajaran model.
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
     * Finds the GuruMataPelajaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GuruMataPelajaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GuruMataPelajaran::find()->where(['id_guru' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
