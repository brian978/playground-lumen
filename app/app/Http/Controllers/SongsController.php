<?php

namespace App\Http\Controllers;

use App\TableGateways\SongsTableGateway;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

class SongsController extends Controller
{
    /**
     * Returns a list of songs
     *
     * @param string|null $service Filter parameter
     * @return JsonResponse
     */
    public function listSongs(?string $service = null): JsonResponse
    {
        return response()->json([$service]);
    }

    /**
     * Imports a bulk list of songs
     *
     * @param Request $request
     * @param SongsTableGateway $songsTable
     * @return JsonResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function importBulk(Request $request, SongsTableGateway $songsTable): JsonResponse
    {
        if (!$request->hasFile('file')) {
            throw new \InvalidArgumentException('File not present');
        }

        /** @var UploadedFile $file */
        $file = $request->file('file');

        $encoder = new CsvEncoder();
        $data = $encoder->decode($file->get(), 'csv');

        $songsTable->insert($data);

        return response()->json([]);
    }
}
