<?php

namespace App\Http\Controllers;

use App\Department;
use App\Faculty;
use App\Time;
use App\University;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class TimeController extends BaseController
{
    public function create($time_start, $time_end, $university_id)
    {
        // Returns class time id
        $time = new Time();
        return $time->create($time_start, $time_end, $university_id);
    }


    public function get_all($university_id)
    {
        return DB::table('class_time')->
        join('universities', 'class_time.university_id', '=', 'universities.id')->
        select('class_time.*')->
        get();
    }


    public function time_exists($university_id, $id)
    {
        $time = DB::table('class_time')->
        join('universities', 'class_time.university_id', '=', 'universities.id')->
        select('class_time.*')->
        where('universities.id', $university_id)->
        where('class_time.id', $id)->
        first();
        if (!$time)
            return false;
        return true;
    }


    public function delete($id)
    {
        $time = Time::where('id', $id)->first();

        if (!$time)
            return false;

        $time->delete();
        return true;
    }
}
