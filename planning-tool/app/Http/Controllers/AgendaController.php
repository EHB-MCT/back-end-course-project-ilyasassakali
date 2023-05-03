<?php

namespace App\Http\Controllers;

use App\Rules\TimeFormat;
use Illuminate\Http\Request;
use App\Models\Vak;
use App\Models\Agenda;


class AgendaController extends Controller
{

    public function index()
    {
        $events = Agenda::all();
        return view('planning.index', compact('events'));
    }
    public function storeEvent(Request $request)
    {
        $data = $request->validate([
            'vak_id' => 'required|integer',
            'datum' => 'required|date',
            'beginuur' => ['required', new TimeFormat()],
            'einduur' => ['required', new TimeFormat()],
            'lokaal' => 'required',
            'leerkracht' => 'required'
        ]);

        Agenda::create($data);

        return redirect()->route('planning.index')->with('success-message', 'Vak succesvol toegevoegd !');
    }




}
