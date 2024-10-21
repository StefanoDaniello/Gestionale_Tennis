<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prenotazione;
use Illuminate\Http\Request;

class PrenotazioniController extends Controller
{
    public function index()
    {
        $prenotazione = Prenotazione::all();
        return response()->json([
            'status' => 'success',
            'message' => 'OK',
            'results' => $prenotazione
        ], 200);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'Data' => 'required|date',  
            'Start_Time' => 'required|date_format:H:i', 
            'End_Time' => 'required|date_format:H:i',              
            'campo_id' => 'required|integer|exists:campi,id', 
        ]);

        $prenotazione = new Prenotazione();

        $prenotazione->Data = $validateData['Data'];
        $prenotazione->Start_Time = $validateData['Start_Time'];
        $prenotazione->End_Time = $validateData['End_Time'];
        $prenotazione->campo_id = $validateData['campo_id'];

        $prenotazione->save();

        return response()->json($prenotazione, 201);
    }
}
