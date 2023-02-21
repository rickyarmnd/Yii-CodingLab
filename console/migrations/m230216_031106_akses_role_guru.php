<?php

use yii\db\Migration;

/**
 * Class m230216_031106_akses_role_guru
 */
class m230216_031106_akses_role_guru extends Migration
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
                    '/lihat-siswa/*', 2, NULL, NULL, NULL, time(), time(),
                ],
                [
                    '/lihat-kelas/*', 2, NULL, NULL, NULL, time(), time(),
                ],
                [  
                    '/tambah-mata-pelajaran/*', 2, NULL, NULL, NULL, time(), time(),
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
                    'Guru1', '/lihat-siswa/*',
                  
                ],
                [
                  
                    'Guru1', '/lihat-kelas/*',
                  
                ],
                [
                  
                   
                    'Guru1', '/tambah-mata-pelajaran/*'
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230216_031106_akses_role_guru cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230216_031106_akses_role_guru cannot be reverted.\n";

        return false;
    }
    */
}
