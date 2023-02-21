<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kelas".
 *
 * @property int $id
 * @property int|null $id_tahun_ajaran
 * @property string|null $nama_kelas
 * @property int|null $id_tingkat
 * @property int|null $id_wali_kelas
 * @property int|null $id_jurusan
 */
class Kelas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kelas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tahun_ajaran', 'id_tingkat', 'id_wali_kelas', 'id_jurusan'], 'default', 'value' => null],
            [['id_tahun_ajaran', 'id_tingkat', 'id_wali_kelas', 'id_jurusan'], 'integer'],
            [['nama_kelas'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_tahun_ajaran' => 'Id Tahun Ajaran',
            'nama_kelas' => 'Nama Kelas',
            'id_tingkat' => 'Id Tingkat',
            'id_wali_kelas' => 'Id Wali Kelas',
            'id_jurusan' => 'Id Jurusan',
        ];
    }

    public function siswaKelas($id){
        
    }


    // public function getListSiswa(){
    //     return $this->hasOne(Siswa::className(), ['id_kelas' => 'id_kelas']);
    // }
    public function getIdSiswa(){
        return $this->hashOne(Siswa::className(), ['id' => 'id_siswa']);
    }
    public function getIdTingkat(){
        return $this->hasOne(RefTingkatKelas::className(), ['id' => 'id_tingkat']);
    }
    public function getWaliKelas(){
        return $this->hasOne(Guru::className() , ['id' => 'id_wali_kelas']);
    }
    public function getTahunAjaran(){
        return $this->hasOne(RefTahunAjaran::className(), ['id' =>'id_tahun_ajaran']);
    }
    public function getJurusan(){
        return $this->hasOne(RefJurusan::className(), ['id' => 'id_jurusan']);
    }}
