<?php

use yii\db\Migration;

/**
 * Class m231124_152727_add_profile_id_to_user_table
 */
class m231124_152727_add_profile_id_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231124_152727_add_profile_id_to_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231124_152727_add_profile_id_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
