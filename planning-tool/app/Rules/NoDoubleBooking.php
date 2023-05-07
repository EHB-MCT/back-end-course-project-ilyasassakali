<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Agenda;

class NoDoubleBooking implements Rule
{
    protected $eventId;

    public function __construct($eventId = null)
    {
        $this->eventId = $eventId;
    }

    public function passes($attribute, $value)
    {
        $beginuur = request()->input('beginuur');
        $einduur = request()->input('einduur');
        $datum = request()->input('datum');
        $lokaal = request()->input('lokaal');
        $leerkracht = request()->input('leerkracht');

        $existingEvents = Agenda::where('datum', $datum)
            ->when($this->eventId, function ($query) {
                $query->where('id', '<>', $this->eventId);
            })
            ->where(function ($query) use ($lokaal, $leerkracht) {
                $query->where('lokaal', $lokaal)
                    ->orWhere('leerkracht', $leerkracht);
            })
            ->where(function ($query) use ($beginuur, $einduur) {
                $query->where(function ($query) use ($beginuur, $einduur) {
                    $query->where('beginuur', '<', $einduur)
                        ->where('einduur', '>', $beginuur);
                });
            })->count();

        return $existingEvents == 0;
    }

    public function message()
    {
        return 'De gekozen leraar of lokaal zijn al bezet voor het geselecteerde tijdstip.';
    }
}

