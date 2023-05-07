<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Agenda;

class NoDoubleBooking implements Rule
{
    public function __construct()
    {
    }

    public function passes($attribute, $value)
    {
        $beginuur = request()->input('beginuur');
        $einduur = request()->input('einduur');
        $datum = request()->input('datum');
        $lokaal = request()->input('lokaal');
        $leerkracht = request()->input('leerkracht');

        $existingEvents = Agenda::where('datum', $datum)
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

