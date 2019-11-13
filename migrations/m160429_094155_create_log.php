<?php

use yii\db\Migration;

class m160429_094155_create_log extends Migration
{
    public function up()
    {
        $this->createTable('{{%log}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'user_id' => $this->integer(),
            'message' => $this->text(),
        ]);

        $this->createIndex('idx-log-user_id', '{{%log}}', 'user_id');
    }

    public function down()
    {
        $this->dropTable('{{%log}}');
    }
}
