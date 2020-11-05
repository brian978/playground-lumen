<?php

namespace App\TableGateways;

class SongsTableGateway extends AbstractTableGateway
{
    protected $tableName = 'songs';

    public function insert(array $data): int
    {
        $sql = "INSERT INTO {$this->tableName} (name, source) VALUES ";

        // Optimized insert for very large dataset (1.500.000 records)
        foreach (array_chunk($data, 500) as $chunk) {
            $pdo = $this->getPdo();

            $values = [];
            $params = [];
            foreach ($chunk as $idx => $row) {
                $values[] = "(:name_{$idx}, :source_{$idx})";

                $params["name_{$idx}"] = $row['name'];
                $params["source_{$idx}"] = $row['source'];
            }

            $statement = $pdo->prepare($sql . implode(', ', $values));
            foreach ($params as $param => $variable) {
                $statement->bindParam($param, $variable);
            }

            $statement->execute();
        }

        return count($data);
    }

    public function select(array $where): array
    {
        return $this->table()->where($where)->get()->toArray();
    }

    public function update(array $data, array $where): int
    {
        $this->table()->where($where)->update($data);
    }

    public function delete(array $where): int
    {
        $this->table()->where($where)->delete();
    }
}