<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subcriber`.
 */
class m161114_045829_create_subcriber_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'phone' => $this->integer(),
            'id_product' => $this->integer(),
            'address' => $this->string(),
            'number' => $this->integer(),
            'price' => $this->integer(),
            'status' => $this->integer(),
            'total' => $this->integer(),
            'id_sub' => $this->integer(11),
            'id_user' => $this->integer(11),
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
