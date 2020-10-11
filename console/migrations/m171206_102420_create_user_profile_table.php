<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_profile`.
 */
class m171206_102420_create_user_profile_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_profile', [
            'user_id' => $this->integer()->unsigned(),
            'first_name' => $this->string(255),
            'last_name' => $this->string(255),
            'display_name' => $this->string(255),
            'about' => $this->text(),
            'avatar' => $this->text()->defaultValue('no-avatar.png'),
            'gender' => $this->smallInteger(5)->defaultValue(1),
            'date_of_birth' => $this->date(),
            'phone_number' => $this->string(64),
            'mobile' => $this->string(64)
        ]);

        $this->createIndex(
            'idx-user_profile-user_id',
            'user_profile',
            'user_id'
        );

        $this->addForeignKey(
            'fk-user_profile-user_id',
            'user_profile',
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
            'fk-user_profile-user_id',
            'user_profile'
        );

        $this->dropIndex(
            'idx-user_profile-user_id',
            'user_profile'
        );

        $this->dropTable('user_profile');
    }
}
