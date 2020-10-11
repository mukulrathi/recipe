<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_address`.
 */
class m171206_103028_create_user_address_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_address', [
            'user_id' => $this->integer()->unsigned(),
            'address' => $this->string(),
            'locality' => $this->string(),
            'city' => $this->string(),
            'state' => $this->string(),
            'country' => $this->string(),
            'latitude' => $this->string(),
            'longitude' => $this->string(),
            'postal_code' => $this->string(),
            'place_id' => $this->string(),
        ]);

        $this->createIndex(
            'idx-user_address-user_id',
            'user_address',
            'user_id'
        );

        $this->addForeignKey(
            'fk-user_address-user_id',
            'user_address',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-user_address-user_id',
            'user_address'
        );

        $this->dropIndex(
            'idx-user_address-user_id',
            'user_address'
        );

        $this->dropTable('user_address');
    }
}
