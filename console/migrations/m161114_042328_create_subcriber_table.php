<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subcriber`.
 */
class m161114_042328_create_subcriber_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('subcriber', [
            'id' => $this->primaryKey(),
            'phone' => $this->integer(),
            'name' => $this->string(),
            'status' => $this->integer(),
            'state' => $this->text(),
            'note_admin' => $this->text(),
            'address' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('subcriber');
    }
}
