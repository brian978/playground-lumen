<?php

namespace App\TableGateways;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder as QueryBuilder;

abstract class AbstractTableGateway implements TableGatewayInterface
{
    protected $db;

    protected $table;

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    protected function table(?string $as = null): QueryBuilder
    {
        return $this->db->query()->from($this->table, $as);
    }
}