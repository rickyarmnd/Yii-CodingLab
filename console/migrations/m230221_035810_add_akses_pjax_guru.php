<?php

use yii\db\Migration;

/**
 * Class m230221_035810_add_akses_pjax_guru
 */
class m230221_035810_add_akses_pjax_guru extends Migration
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
                    '/tes-pjax/*', 2, NULL, NULL, NULL, time(), time(),
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
                    'Admin', '/tes-pjax/*'
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230221_035810_add_akses_pjax_guru cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230221_035810_add_akses_pjax_guru cannot be reverted.\n";

        return false;
    }
    */
}
