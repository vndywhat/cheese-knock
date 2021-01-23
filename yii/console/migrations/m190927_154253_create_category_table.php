<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m190927_154253_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(10)->notNull()->defaultValue(0),
            'title' => $this->string(255)->notNull(),
            'description' => $this->string(255),
            'image' => $this->string(255),
            'thumbnail' => $this->string(255),
            'keywords' => $this->string(255),
            'meta_description' => $this->string(255),
            'slug' => $this->string(255)->notNull()->unique(),
            'created_at' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
