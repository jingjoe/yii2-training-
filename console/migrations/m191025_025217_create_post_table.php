<?php

use yii\db\Schema; // ใช้ Schema
use yii\db\Migration;


class m191025_025217_create_post_table extends Migration{

    public function safeUp() {
        $this->createTable('{{%post}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . " NOT NULL COMMENT 'หัวข้อ'", //แก้ไขโดยใส่ comment
            'content' => Schema::TYPE_TEXT . " NULL COMMENT 'รายละเอียด'", //แก้ไขโดยใส่ comment
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
