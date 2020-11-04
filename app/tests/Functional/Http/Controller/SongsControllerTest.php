<?php

namespace Tests\Functional\Http\Controller;

use Tests\TestCase;

class SongsControllerTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->get('/api/v1/songs/itunes')
            ->seeStatusCode(200);
    }
}