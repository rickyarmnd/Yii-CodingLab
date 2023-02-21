<?php

use yii\db\Migration;

/**
 * Class m230216_034359_tambah_akses_daftar_kelas_guru
 */
class m230216_034359_tambah_akses_daftar_kelas_guru extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
           $this->batchInsert(
            'auth_item',
            [
                'name',
                'type',
                'description',
                'rule_name',
                'data',
                'created_at',
                'updated_at'
            ],
            [
                [  
                    '/daftar-kelas/*', 2, NULL, NULL, NULL, time(), time(),
                ],
            ]
        );

        $this->batchInsert(
            'auth_item_child',
            [
                'parent',
                'child'
            ],
            [
                [
                    'Guru1', '/daftar-kelas/*',
                  
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230216_034359_tambah_akses_daftar_kelas_guru cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230216_034359_tambah_akses_daftar_kelas_guru cannot be reverted.\n";

        return false;
    }
    */
}
