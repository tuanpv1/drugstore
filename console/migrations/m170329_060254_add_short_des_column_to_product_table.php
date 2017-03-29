<?php

use yii\db\Migration;

/**
 * Handles adding short_des to table `product`.
 */
class m170329_060254_add_short_des_column_to_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('product', 'short_des', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('product', 'short_des');
    }
}
