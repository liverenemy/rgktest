<?php

use yii\db\Schema;
use yii\db\Migration;

class m150807_111927_books extends Migration
{
    public function safeUp()
    {
        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'date_create' => $this->timestamp()->notNull()->defaultValue(0),
            'date_update' => $this->timestamp()->notNull()->defaultValue(0),
            'preview' => $this->string()->notNull()->defaultValue(''),
            'date' => $this->date()->notNull(),
            'author_id' => $this->integer(),
        ]);
        $this->addForeignKey('fk_books_author_id', 'books', 'author_id', 'authors', 'id', 'cascade', 'cascade');
    }

    public function safeDown()
    {
        $this->dropTable('books');
    }
}
