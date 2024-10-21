<?php

namespace App\Http\Controllers\Api;
use App\Models\Campo;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CampiController extends Controller
{
    public function index()
    {
        $campi = Campo::all();
        return response()->json([
            'status' => 'success',
            'message' => 'OK',
            'results' => $campi
        ], 200);
    }
}
