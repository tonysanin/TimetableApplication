<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Time extends Model
{
    public $timestamps = false;
    protected $table = 'class_time';


    public function create($time_start, $time_end, $university_id)
    {
        // Returns new class time id
        $time = new Time();
        $time->time_start = $time_start;
        $time->time_end = $time_end;
        $time->university_id = $university_id;
        $time->save();

        return $time->id;
    }
}
