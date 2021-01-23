<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_related}}`.
 */
class m191024_153415_create_order_related_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_related}}', [
            'id' => $this->primaryKey(),
            'order_item_id' => $this->integer(11)->notNull(),
            'ingredient_id' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_related}}');
    }
}
