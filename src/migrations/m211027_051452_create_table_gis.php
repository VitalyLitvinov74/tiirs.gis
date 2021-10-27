<?php

use yii\db\Migration;

/**
 * Class m211027_051452_create_table_gis
 */
class m211027_051452_create_table_gis extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('vloop_location_users', [
            'id'=>$this->primaryKey(),
            'user_id'=>$this->integer(),
            'longitude_x'=> $this->float(),
            'latitude_y'=> $this->float(),
            'time'=> $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('vloop_location_users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211027_051452_create_table_gis cannot be reverted.\n";

        return false;
    }
    */
}
