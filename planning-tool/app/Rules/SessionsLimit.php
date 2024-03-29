<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Vak;
use App\Models\Agenda;

class SessionsLimit implements Rule
{
    protected $vak_id;
    protected $eventId;

    public function __construct($vak_id, $eventId = null)
    {
        $this->vak_id = $vak_id;
        $this->eventId = $eventId;
    }

    public function passes($attribute, $value)
    {
        $vak = Vak::find($this->vak_id);
        $plannedSessions = Agenda::where('vak_id', $this->vak_id)
            ->when($this->eventId, function ($query) {
                $query->where('id', '<>', $this->eventId);
            })->count();

        return $plannedSessions < $vak->sessies;
    }

    public function message()
    {
        return 'Alle sessies voor dit vak zijn al gepland. U kunt niet meer sessies plannen voor dit vak.';
    }
}
