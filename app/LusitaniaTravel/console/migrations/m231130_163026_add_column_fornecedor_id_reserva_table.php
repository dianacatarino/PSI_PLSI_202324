<?php

use yii\db\Migration;

/**
 * Class m231130_163026_add_column_fornecedor_id_reserva_table
 */
class m231130_163026_add_column_fornecedor_id_reserva_table extends Migration
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
        echo "m231130_163026_add_column_fornecedor_id_reserva_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231130_163026_add_column_fornecedor_id_reserva_table cannot be reverted.\n";

        return false;
    }
    */
}
