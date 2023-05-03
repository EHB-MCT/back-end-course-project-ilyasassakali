<?php

namespace App\Http\Controllers;

use App\Rules\TimeFormat;
use Illuminate\Http\Request;
use App\Models\Vak;
use App\Models\Agenda;
use function Sodium\compare;


class AgendaController extends Controller
{


    public function dashboard()
    {
        $events = Agenda::with('vak')->get();
        $calendarEvents = $events->map(function ($event) {
            return [
                'title' => $event->vak->naam . ' - ' . $event->vak->opleiding . ' - ' . $event->leerkracht . ' - ' . $event->lokaal,
                'start' => $event->datum . 'T' . $event->beginuur,
                'end' => $event->datum . 'T' . $event->einduur,
            ];
        });

        return view('dashboard', compact('calendarEvents'));
    }


    public function index()
    {
        $events = Agenda::with('vak')->get();
        $calendarEvents = $events->map(function ($event) {
            return [
                'title' => $event->vak->naam . ' - ' . $event->vak->opleiding . ' - ' . $event->leerkracht . ' - ' . $event->lokaal,
                'start' => $event->datum . 'T' . $event->beginuur,
                'end' => $event->datum . 'T' . $event->einduur,
            ];
        });

        return view('planning.index', compact('calendarEvents'));


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
