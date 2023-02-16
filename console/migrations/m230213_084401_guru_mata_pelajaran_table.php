<?php

use yii\db\Migration;

/**
 * Class m230213_084401_guru_mata_pelajaran_table
 */
class m230213_084401_guru_mata_pelajaran_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%guru_mata_pelajaran}}', [
           
            'id_guru' => $this->integer(),
           
            'id_mata_pelajaran' => $this->integer(),
            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230213_084401_guru_mata_pelajaran_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230213_084401_guru_mata_pelajaran_table cannot be reverted.\n";

        return false;
    }
    */
}
