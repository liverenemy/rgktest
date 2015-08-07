<?php

use yii\db\Schema;
use yii\db\Migration;

class m150807_084845_author extends Migration
{
    public function safeUp()
    {
        $this->createTable('authors', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(),
            'lastname' => $this->string(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('authors');
    }
}
