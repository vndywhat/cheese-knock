<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%related}}`.
 */
class m191021_103719_create_related_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%related}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%related}}');
    }
}
