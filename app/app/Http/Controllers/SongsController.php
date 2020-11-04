<?php

namespace App\Http\Controllers;

class SongsController extends Controller
{
    /**
     * Returns a list of songs
     *
     * @param string|null $service Filter parameter
     */
    public function listSongs(?string $service = null)
    {
        return response()->json([]);
    }
}
