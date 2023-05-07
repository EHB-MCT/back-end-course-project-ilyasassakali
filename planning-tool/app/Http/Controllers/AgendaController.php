<?php

namespace App\Http\Controllers;

use App\Rules\DurationMatchesVak;
use App\Rules\NoDoubleBooking;
use App\Rules\SemesterDate;
use App\Rules\SessionsLimit;
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
                'id' => $event->id,
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
            'vak_id' => ['required', 'integer', new SessionsLimit($request->vak_id)],
            'datum' => ['required', 'date', new SemesterDate($request->vak_id)],
            'beginuur' => ['required', new TimeFormat(), new NoDoubleBooking()],
            'einduur' => ['required', new TimeFormat(), new DurationMatchesVak($request->vak_id)],
            'lokaal' => 'required',
            'leerkracht' => 'required'
        ]);

        Agenda::create($data);

        return redirect()->route('planning.index')->with('success-message', 'Evenement succesvol gepland!');
    }



    public function deleteEvent(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->route('planning.index')->with('success-message', 'Evenement succesvol verwijderd!');
    }


    public function update(Request $request, Agenda $agenda)
    {
        $data = $request->validate([
            'vak_id' => ['required', 'integer', new SessionsLimit($request->vak_id)],
            'datum' => ['required', 'date', new SemesterDate($request->vak_id)],
            'beginuur' => ['required', new TimeFormat(), new NoDoubleBooking()],
            'einduur' => ['required', new TimeFormat(), new DurationMatchesVak($request->vak_id)],
            'lokaal' => 'required',
            'leerkracht' => 'required'
        ]);

        $agenda->update($data);

        return redirect()->route('planning.index')->with('success-message', 'Evenement succesvol bijgewerkt!');
    }



}
