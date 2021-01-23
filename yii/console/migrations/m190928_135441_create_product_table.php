<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m190928_135441_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(11)->notNull()->defaultValue(0), //категория
            'title' => $this->string(255)->notNull(), //название
            'description' => $this->text(), //описание
            'composition' => $this->string(255), //состав
            'size' => $this->string(25), //размер
            'weight' => $this->string(25), //вес
            'price' => $this->decimal(10,2)->notNull()->defaultValue(0.00), //цена
            'image' => $this->string(255)->defaultValue(null), //имя файла изображения
            'thumbnail' => $this->string(255)->defaultValue(null), //имя файла тумбы
            'meta_keywords' => $this->string(50), //ключевые слова
            'meta_description' => $this->string(50), //мета описание
            'slug' => $this->string(255)->notNull()->unique(), //уникальный url
            'have_related' => $this->integer(1)->notNull()->defaultValue(0), //доп. ингридиенты
            'is_drink' => $this->integer(1)->notNull()->defaultValue(0), //напиток?
            'is_new' => $this->integer(1)->notNull()->defaultValue(0), //новинка?
            'sales_count' => $this->integer(11)->notNull()->defaultValue(0), //количество продаж
            'created_at' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
