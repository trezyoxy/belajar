<?php

namespace App\Http\Controllers\Api; // Harus sesuai folder

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class BMKGController extends Controller
{
    public function getGempa()
    {
        $response = Http::get('https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json');
        return response()->json($response->json());
    }
}

