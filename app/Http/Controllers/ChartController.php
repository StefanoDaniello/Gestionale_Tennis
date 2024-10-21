<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campo;
use App\Models\Prenotazione;
use Carbon\Carbon; 

class ChartController extends Controller
{
    public function index(Request $request)
    {
        // Ottieni tutti i campi
        $campi = Campo::all();
        $prenotazioni = Prenotazione::with('campo')->get();



        // Filtra le prenotazioni per la data odierna
        if ($request->input('campoId')) {
            $campoId = $request->input('campoId');
            $prenotazioniOggi = Prenotazione::with('campo')
                ->whereDate('Data', Carbon::today())
                ->where('campo_id', $campoId)
                ->get();

            // Conta le prenotazioni di oggi
            $prenotazioniTotaliOggi = $prenotazioniOggi->count();
        }else{
            $prenotazioniOggi = Prenotazione::with('campo')
                ->whereDate('Data', Carbon::today())
                ->get();
            $prenotazioniTotaliOggi = $prenotazioniOggi->count();
        }




        //Prenotazioni Annuali
        
        //creo un array di 12 elementi  tutti con valore 0
        $arrYear = array_fill(0, 12, 0);

        // Ottieni tutte le prenotazioni dell'anno corrente
        $prenotazioniYear = $request->input('campoId')
            ? Prenotazione::with('campo')
                ->whereYear('Data', Carbon::now()->year)
                ->where('campo_id', $request->input('campoId'))
                ->get()
            : Prenotazione::whereYear('Data', Carbon::now()->year)->get();


        // Conta le prenotazioni per ogni mese
        foreach ($prenotazioniYear as $prenotazione) {
            // date('n') il numero del mese
            // strtotime converto la data in timestamp
            $mese = date('n', strtotime($prenotazione->Data)); 
            //prreno il primo elemento ovvero 0 e poi incremento per ogni prenotazione
            $arrYear[$mese - 1]++; 
        }


        // Prenotazioni Mensili

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Ottieni il numero di giorni del mese corrente
        $daysInMonth = Carbon::now()->daysInMonth;

        $arrMonth = array_fill(1, $daysInMonth, 0);

        
        $prenotazioniMonth = $request->input('campoId')
            ? Prenotazione::with('campo')
                ->whereMonth('Data', $currentMonth)
                ->whereYear('Data', $currentYear)
                ->where('campo_id', $request->input('campoId'))
                ->get()
            : Prenotazione::whereMonth('Data', $currentMonth)
                ->whereYear('Data', $currentYear)
                ->get();

        foreach ($prenotazioniMonth as $prenotazione) {
            // converte una stringa in un oggetto Carbon
            $day = Carbon::parse($prenotazione->Data)->day;
            $arrMonth[$day]++;
        }




        // Prenotazioni Settimanali

        // numero della settimana corrente
        $currentWeek = Carbon::now()->weekOfYear;

        $arrWeek = array_fill(1, 7, 0);

        // Fetch weekly bookings, considering campoId if provided
        $prenotazioniWeek = $request->input('campoId')
            ? Prenotazione::with('campo')
                ->whereYear('Data', $currentYear)
                ->whereMonth('Data', $currentMonth)
                ->where('campo_id', $request->input('campoId'))
                ->whereRaw('WEEK(Data, 1) = ?', [$currentWeek])
                ->get()
            : Prenotazione::whereYear('Data', $currentYear)
                ->whereMonth('Data', $currentMonth)
                // restituisce il numero della settimana per una data specificata 
                // 1 significa lunedi conforme ad ISO-8601
                ->whereRaw('WEEK(Data, 1) = ?', [$currentWeek])
                ->get();

        foreach ($prenotazioniWeek as $prenotazione) {
            // formato ISO-8601  da 1 a 7 
            $dayOfWeek = Carbon::parse($prenotazione->Data)->dayOfWeekIso;
            $arrWeek[$dayOfWeek]++;
        }


        if ($request->ajax()) {
            return response()->json([
                'prenotazioniTotaliOggi' => $prenotazioniTotaliOggi,
                'arrYear' => $arrYear,
                'arrMonth' => $arrMonth,
                'arrWeek' => $arrWeek,
            ]);
        }
        return view('grafici', compact('campi', 'prenotazioni' ,'prenotazioniTotaliOggi','arrYear','arrMonth','arrWeek')); 
        
    }
}
