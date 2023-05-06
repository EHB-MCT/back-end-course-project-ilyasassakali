<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Vak;
use Carbon\Carbon;

class SemesterDate implements Rule
{
    protected $vak_id;

    public function __construct($vak_id)
    {
        $this->vak_id = $vak_id;
    }

    public function passes($attribute, $value)
    {
        $vak = Vak::find($this->vak_id);
        $semester = $vak->semester;
        $eventDate = Carbon::parse($value);

        if ($semester == 1) {
            $startSemester = Carbon::createFromDate($eventDate->year, 9, 1);
            $endSemester = Carbon::createFromDate($eventDate->year, 1, 31)->addYear();

            return $eventDate->between($startSemester, $endSemester);
        } elseif ($semester == 2) {
            $startSemester = Carbon::createFromDate($eventDate->year, 2, 1);
            $endSemester = Carbon::createFromDate($eventDate->year, 6, 30);

            return $eventDate->between($startSemester, $endSemester);
        }

        return false;
    }

    public function message()
    {
        return 'Het evenement kan alleen worden gepland binnen de toegestane semester.';
    }
}
