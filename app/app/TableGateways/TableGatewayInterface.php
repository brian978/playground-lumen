<?php

namespace App\TableGateways;

interface TableGatewayInterface
{
    public function insert(array $data): int;

    public function select(array $where): array;

    public function update(array $data, array $where): int;

    public function delete(array $where): int;
}