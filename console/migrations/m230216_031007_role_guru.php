<?php

use yii\db\Migration;

/**
 * Class m230216_031007_role_guru
 */
class m230216_031007_role_guru extends Migration
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
                    'Guru1', 1, NULL, NULL, NULL, time(), time()
                ],
            ]
        );

        $this->batchInsert(
            'auth_assignment',
            [
                'item_name',
                'user_id',
                'created_at',
            ],
            [
                [
                    'Guru1',
                    '7',
                    NULL
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230216_031007_role_guru cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230216_031007_role_guru cannot be reverted.\n";

        return false;
    }
    */
}
