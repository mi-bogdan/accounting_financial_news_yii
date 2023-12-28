<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%KyrsPeriod}}`.
 */
class m231207_081054_create_KyrsPeriod_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%KyrsPeriod}}', [
            'id' => $this->primaryKey(),
            'data' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'kyrs' => $this->float()->notNull(),
            'change' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%KyrsPeriod}}');
    }
}
