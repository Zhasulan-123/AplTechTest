<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m230819_082723_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название продукта'),
            'category_name' => $this->string()->notNull()->comment('Название категория'),
            'brand_name' => $this->string()->comment('Название бренда'),
            'price' => $this->integer()->notNull()->comment('Цена продукта'),
            'rrp_price' => $this->integer()->notNull()->comment('Цена по акций продукта'),
            'status' => $this->integer()->defaultValue(1)->comment('Статус 1 -в наличии, 2 - под заказ'),
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