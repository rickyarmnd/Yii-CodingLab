<?php

use yii\db\Migration;

/**
 * Class m230213_154908_add_id_user_guru
 */
class m230213_154908_add_id_user_guru extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('guru', 'id_user', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230213_154908_add_id_user_guru cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230213_154908_add_id_user_guru cannot be reverted.\n";

        return false;
    }
    */
}
