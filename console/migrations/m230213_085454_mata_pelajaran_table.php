<?php

use yii\db\Migration;

/**
 * Class m230213_085454_mata_pelajaran_table
 */
class m230213_085454_mata_pelajaran_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%mata_pelajaran}}', [
            'id' => $this->primaryKey(),
            'mata_pelajaran' => $this->string(25),
            'id_tingkat_kelas' => $this->integer(),
            'id_jurusan' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230213_085454_mata_pelajaran_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230213_085454_mata_pelajaran_table cannot be reverted.\n";

        return false;
    }
    */
}
