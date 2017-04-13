<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tracker_user`.
 */
class m170413_041924_create_tracker_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tracker_user', [
            'id' => $this->primaryKey(),
            'ip' => $this->string(),
            'phone' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'number' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tracker_user');
    }
}
