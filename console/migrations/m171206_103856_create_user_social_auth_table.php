<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_social_auth`.
 */
class m171206_103856_create_user_social_auth_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_social_auth', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->unsigned(),
            'source' => $this->string()->notNull(),
            'source_id' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        $this->addForeignKey('fk-user_social_auth-user_id-user-id', 'user_social_auth', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-user_social_auth-user_id-user-id',
            'user_social_auth'
        );

        $this->dropTable('user_social_auth');
    }
}
