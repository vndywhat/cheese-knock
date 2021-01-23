<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m191013_104357_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'address' => $this->string(255)->defaultValue(''),
            'porch' => $this->string(50)->defaultValue(''),
            'floor' => $this->string(50)->defaultValue(''),
            'flat' => $this->string(50)->defaultValue(''),
            'phone' => $this->string(255)->notNull(),
            'delivery_time' => $this->string(255)->defaultValue(''),
            'comment' => $this->text(),
            'amount' => $this->decimal(10, 2)->notNull()->defaultValue(0.00),
            'status' => $this->integer(1)->notNull()->defaultValue(0),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
