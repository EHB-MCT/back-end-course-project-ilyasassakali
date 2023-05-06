<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Vak;

class DurationMatchesVak implements Rule
{
    protected $vak_id;

    public function __construct($vak_id)
    {
        $this->vak_id = $vak_id;
    }

    public function passes($attribute, $value)
    {
        $beginuur = strtotime(request()->beginuur);
        $einduur = strtotime($value);
        $calculatedDuration = ($einduur - $beginuur) / 60;

        $vak = Vak::find($this->vak_id);
        $duur = \DateTime::createFromFormat('H:i:s', $vak->duur);
        $expectedDuration = $duur->format('H') * 60 + $duur->format('i');

        return $calculatedDuration === $expectedDuration;
    }

    public function message()
    {
        return 'De duur van het evenement komt niet overeen met de duur van het vak.';
    }
}
