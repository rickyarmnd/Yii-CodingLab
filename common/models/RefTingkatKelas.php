<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ref_tingkat_kelas".
 *
 * @property int $id
 * @property string|null $tingkat_kelas
 */
class RefTingkatKelas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_tingkat_kelas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tingkat_kelas'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tingkat_kelas' => 'Tingkat Kelas',
        ];
    }
}
