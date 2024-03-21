<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Ticket extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('ticket');

        $table->addColumn('ticket_code', 'string', ['limit' => 20])
            ->addcolumn('event_id', 'integer')
            ->addcolumn('status', 'string', ['limit' => 15])
            ->addTimestamps()
            ->create();
    }
}
