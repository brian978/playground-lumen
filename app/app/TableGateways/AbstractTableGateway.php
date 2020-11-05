<?php

namespace App\TableGateways;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * Class AbstractTableGateway
 *
 * @method void commit()
 * @method void rollback()
 * @method void beginTransaction()
 * @method \PDO getPdo()
 *
 * @package App\TableGateways
 */
abstract class AbstractTableGateway implements TableGatewayInterface
{
    private $db;

    protected $tableName;

    protected $connectionName = 'default';

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    protected function table(?string $as = null): QueryBuilder
    {
        if (empty($this->tableName)) {
            throw new \RuntimeException('The table was not defined!');
        }

        return $this->db->connection($this->connectionName)->query()->from($this->tableName, $as);
    }

    public function __call(string $method, array $arguments)
    {
        if (method_exists($this->db->connection($this->connectionName), $method)) {
            return call_user_func_array([$this->db, $method], $arguments);
        }
    }
}