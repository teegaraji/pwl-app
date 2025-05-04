<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tutorial;

class TutorialApiController extends Controller
{
    public function getTutorialsByMatkul(string $kode_matkul)
    {
        $tutorials = Tutorial::where('course_code', $kode_matkul)->get();

        if ($tutorials->isEmpty()) {
            return response()->json([
                'results' => [],
                'status' => [
                    'code' => 404,
                    'description' => 'Not Found Data'
                ]
            ], 404);
        }

        $result = $tutorials->map(function ($item) {
            return [
                'kode_matkul'       => $item->kode_matkul,
                'nama_matkul'       => $item->nama_matkul,
                'judul'             => $item->title,
                'url_presentation'  => $item->url_presentation,
                'url_finished'      => $item->url_finished,
                'creator_email'     => $item->creator_email,
                'created_at'        => $item->created_at->format('Y-m-d H:i:s'),
                'updated_at'        => $item->updated_at->format('Y-m-d H:i:s'),
            ];
        });

        return response()->json([
            'results' => $result,
            'status' => [
                'code' => 200,
                'description' => 'OK'
            ]
        ]);
    }
}
