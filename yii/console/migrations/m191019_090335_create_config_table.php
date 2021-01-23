<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%config}}`.
 */
class m191019_090335_create_config_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%config}}', [
            'id' => $this->integer(11)->defaultValue(1),
            'about' => $this->text()->notNull(),
            'phone' => $this->string(255)->notNull(),
            'orders' => $this->string(255)->notNull(),
            'address' => $this->string(100)->notNull(),
            'regime' => $this->string(100)->notNull(),
            'main_office' => $this->string(100)->notNull(),
            'time_work' => $this->string(100)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%config}}');
    }
}
