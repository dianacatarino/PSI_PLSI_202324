<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%carrinho}}`.
 */
class m231211_170233_create_carrinho_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%carrinho}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%carrinho}}');
    }
}
