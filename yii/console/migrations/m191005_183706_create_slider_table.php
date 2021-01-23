<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%slider}}`.
 */
class m191005_183706_create_slider_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%slider}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'subtitle' => $this->string(255),
            'price' => $this->integer(11),
            'excerpt' => $this->text(),
            'link' => $this->text(),
            'image' => $this->string(255)->notNull(),
            'created_at' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%slider}}');
    }
}
