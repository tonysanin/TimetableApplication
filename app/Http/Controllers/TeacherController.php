<?php

namespace App\Http\Controllers;

use App\Auditory;
use App\Teacher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class TeacherController extends BaseController
{
    public function create($full_name, $short_name, $department_id)
    {
        // Returns new teacher id
        $teacher = new Teacher();
        return $teacher->create($full_name, $short_name, $department_id);
    }


    public function get_university_teachers($university_id)
    {
        return DB::table('universities')->
            join('faculties', 'faculties.university_id', '=', 'universities.id')->
            join('departments', 'departments.faculty_id', '=', 'faculties.id')->
            join('teachers', 'teachers.department_id', '=', 'departments.id')->
            select('teachers.*')->get();
    }


    public function teacher_exists($university_id, $id)
    {
        $teacher = DB::table('universities')->
        join('faculties', 'faculties.university_id', '=', 'universities.id')->
        join('departments', 'departments.faculty_id', '=', 'faculties.id')->
        join('teachers', 'teachers.department_id', '=', 'departments.id')->
        where('teachers.id', $id)->
        select('teachers.*')->first();

        if (!$teacher)
            return false;
        return true;
    }


    public function delete($id)
    {
        $teacher = Teacher::where('id', $id)->first();
        if (!$teacher)
            return false;
        $teacher->delete();
        return true;
    }


    public function rename($id, $full_name, $short_name)
    {
        $teacher = Teacher::where('id', $id)->first();
        if (!$teacher)
            return false;
        $teacher->full_name = $full_name;
        $teacher->short_name = $short_name;
        $teacher->save();

        return true;
    }
}
