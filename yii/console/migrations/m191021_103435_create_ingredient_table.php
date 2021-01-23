<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ingredients}}`.
 */
class m191021_103435_create_ingredient_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ingredient}}', [
            'id' => $this->primaryKey(),
            'related_id' => $this->integer(11)->defaultValue(0),
            'title' => $this->string(255)->notNull(),
            'price' => $this->decimal(10,2)->notNull()->defaultValue(0.00),
            'weight' => $this->string(50),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ingredient}}');
    }
}
