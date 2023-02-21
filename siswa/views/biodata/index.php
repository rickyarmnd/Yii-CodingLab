<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\widgets\DetailView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel siswa\models\BiodataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Biodata';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<!-- <div class="element-wrapper">
    <h6 class="element-header">
            </h6>
    <div class="element-box"> -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="ajaxCrudDatatable">

                    <?=// Html::a('Update', ['update','nis'=>$data->nis],[
                        //'class' => 'btn btn-success text-white btn-block mb-3',
                        // 'role'=>'modal-remote',
                        // 'data-toggle'=>'tooltip',
                        // 'title' => 'Update',
                        Html::a('Update Siswa',
                                 ['update' , 'nis' => $data->nis],
                                 ['role'=>'modal-remote','title'=> 'Ubah Siswa',
                                 'class'=>'btn btn-default'
                        
                    ]); ?>
                    <div class="table-responsive">
                    <?php Pjax::begin(['id'=>'id-pjax']); ?>

                    <?= DetailView::widget([
                        'model' => $data,
                        'attributes' => [
                            // 'id',
                            'nis',
                            'nama',
                            'alamat:ntext',
                            'id_kelas',
                            'tempat_lahir',
                            'tanggal_lahir',
                        ],
                    ]) ?>
                    <?php Pjax::end(); ?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
