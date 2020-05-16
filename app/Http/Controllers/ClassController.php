<?php

namespace App\Http\Controllers;

use App\_Class;
use App\Auditory;
use App\Group;
use App\Subject;
use App\Teacher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class ClassController extends BaseController
{
    public function create($subject_id, $auditory_id, $class_time_id, $group_id, $teacher_id, $type_id, $date)
    {
        // Returns new class id
        $class = new _Class();
        return $class->create($subject_id, $auditory_id, $class_time_id, $group_id, $teacher_id, $type_id, $date);
    }


    public function get_all($university_id)
    {
        return DB::table('universities')->
        join('auditories', 'universities.id', '=', 'auditories.university_id')->
        join('classes', 'auditories.id', 'classes.auditory_id')->
        where('universities.id', $university_id)->
        select('classes.*')->get();
    }


    public function class_exists($university_id, $id)
    {
        $class = DB::table('universities')->
        join('auditories', 'universities.id', '=', 'auditories.university_id')->
        join('classes', 'auditories.id', 'classes.auditory_id')->
        where('universities.id', $university_id)->
        where('classes.id', $id)->
        select('classes.*')->first();

        if (!$class)
            return false;
        return true;
    }


    public function delete($id)
    {
        $class = _Class::where('id', $id)->first();

        if (!$class)
            return false;

        $class->delete();

        return true;
    }
}
