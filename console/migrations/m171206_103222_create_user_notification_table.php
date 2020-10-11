<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_notification`.
 */
class m171206_103222_create_user_notification_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_notification', [
            'user_id' => $this->integer()->unsigned(),
            'text_notification' => $this->smallInteger(5)->defaultValue(0),
            'email_notification' => $this->smallInteger(5)->defaultValue(1),
        ]);

        $this->createIndex(
            'idx-user_notification-user_id',
            'user_notification',
            'user_id'
        );

        $this->addForeignKey(
            'fk-user_notification-user_id',
            'user_notification',
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
            'fk-user_notification-user_id',
            'user_notification'
        );

        $this->dropIndex(
            'idx-user_notification-user_id',
            'user_notification'
        );

        $this->dropTable('user_notification');
    }
}
