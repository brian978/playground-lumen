<?php

namespace App\Http\Controllers;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder as QueryBuilder;

class SongsController extends Controller
{
    /**
     * @var DatabaseManager
     */
    private $qb;

    public function __construct(DatabaseManager $dbm)
    {
        $this->qb = $dbm->connection();
    }

    /**
     * Returns a list of songs
     *
     * @param string|null $service Filter parameter
     */
    public function listSongs(?string $service = null)
    {
        $this->qb->table('songs')
            ->when($service, function (QueryBuilder $query, $service) {
                return $query->where('service', $service);
            })
            ->get();
    }
}
