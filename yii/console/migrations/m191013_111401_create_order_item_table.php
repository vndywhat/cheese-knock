<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_item}}`.
 */
class m191013_111401_create_order_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_item}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(11)->notNull(),
            'product_id' => $this->integer(11)->notNull(),
            'price' => $this->decimal(10, 2)->notNull(), //стоимость, вместе с ингредиентами
            'count' => $this->integer(11)->notNull(), //количество
            'ingredients' => $this->text()->notNull(), //ингредиенты
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_item}}');
    }
}
