<?php

use yii\db\Migration;

class m160429_093955_create_order extends Migration
{
    public function up()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%order}}');
    }
}
