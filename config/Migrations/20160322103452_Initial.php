<?php
use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('cake_d_subtasks', ['id' => false, 'primary_key' => ['subtask_id']]);
        $table
            ->addColumn('subtask_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 25,
                'null' => false,
            ])
            ->addColumn('task_id', 'integer', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('status', 'text', [
                'limit' => 32,
                'null' => false,
            ])
            ->addColumn('file', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('comment', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('error', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $table = $this->table('cake_d_tasks', ['id' => false, 'primary_key' => ['task_id']]);
        $table->addColumn('task_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('exec_time', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('status', 'text', [
                'limit' => 32,
                'null' => false,
            ])
            ->addColumn('method', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('directory', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('comment', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('error', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

    }

    public function down()
    {
        $this->dropTable('subtasks');
        $this->dropTable('tasks');
    }
}
