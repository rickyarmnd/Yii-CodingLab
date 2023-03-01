<?php

namespace admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GuruMataPelajaran;
use common\models\Guru;
use common\models\MataPelajaran;

/**
 * GuruMataPelajaranSearch represents the model behind the search form about `common\models\GuruMataPelajaran`.
 */
class GuruMataPelajaranSearch extends GuruMataPelajaran
{

    public $searchNamaGuru;
    public $searchMataPelajaran;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_guru', 'id_mata_pelajaran',], 'integer'],
            [['searchNamaGuru' , 'searchMataPelajaran'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = GuruMataPelajaran::find()->joinWith(['namaGuru', 'mataPelajaran']);
        // $query = GuruMataPelajaran::find()->joinWith(['mataPelajaran']);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $dataProvider->sort->attributes['searchNamaGuru'] = [
            'asc' => ['guru.nama_guru' => SORT_ASC],
            'desc' => ['guru.nama_guru' => SORT_DESC]
        ];

        $dataProvider->sort->attributes['searchMataPelajaran'] = [
            'asc' => ['mata_pelajaran.mata_pelajaran' => SORT_ASC],
            'desc' => ['mata_pelajaran.mata_pelajaran' => SORT_DESC]
        ];

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_guru' => $this->id_guru,
            'id_mata_pelajaran' => $this->id_mata_pelajaran,
            // 'id' => $this->id,
        ]);
        $query->andFilterWhere(['ilike', 'guru.nama_guru', $this->searchNamaGuru])
              ->andFilterWhere(['ilike', 'mata_pelajaran.mata_pelajaran', $this->searchMataPelajaran]);
        return $dataProvider;
    }
}
