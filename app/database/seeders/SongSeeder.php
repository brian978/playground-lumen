<?php

namespace Database\Seeders;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SongSeeder extends Seeder
{
    private $db;

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->db
            ->table('songs')
            ->insert(
                [
                    'name' => Str::random(10),
                    'source' => Str::random(10)
                ]
            );
    }
}
