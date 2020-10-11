<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_verification`.
 */
class m171206_103338_create_user_verification_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_verification', [
            'user_id' => $this->integer()->unsigned(),
            'token' => $this->string()->notNull(),
            'request_time' => $this->dateTime()->notNull(),
            'responded' => $this->smallInteger(5)->defaultValue(0)
        ]);

        $this->createIndex(
            'idx-user_verification-user_id',
            'user_verification',
            'user_id'
        );

        $this->addForeignKey(
            'fk-user_verification-user_id',
            'user_verification',
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
            'fk-user_verification-user_id',
            'user_verification'
        );

        $this->dropIndex(
            'idx-user_verification-user_id',
            'user_verification'
        );

        $this->dropTable('user_verification');
    }
}
