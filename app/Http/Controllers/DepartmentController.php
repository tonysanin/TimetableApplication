<?php

namespace App\Http\Controllers;

use App\Department;
use App\Faculty;
use App\University;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class DepartmentController extends BaseController
{
    public function create($faculty_id, $full_name, $short_name)
    {
        // Returns faculty id
        $department = new Department();
        return $department->create($faculty_id, $full_name, $short_name);
    }


    public function get_all_university_departments($university_id)
    {
        return DB::table('departments')
            ->join('faculties', 'faculties.id', '=', 'departments.faculty_id')
            ->where('faculties.university_id', $university_id)
            ->select('departments.*')
            ->get();
    }


    public function delete_faculty_departments($faculty_id)
    {
        DB::table('departments')
            ->join('faculties', 'faculties.id', '=', 'departments.faculty_id')
            ->where('faculties.id', $faculty_id)
            ->delete();
    }


    public function delete_all_departments($university_id)
    {
        DB::table('departments')
            ->join('faculties', 'faculties.id', '=', 'departments.faculty_id')
            ->where('faculties.university_id', $university_id)
            ->delete();

        return true;
    }


    public function delete($id, $university_id)
    {
        $department = Department::where('id', $id)->first();
        if (!$department)
            return false;
        $faculty = Faculty::where('id', $department->faculty_id)->where('university_id', $university_id)->first();
        if (!$faculty)
            return false;
        $department->delete();

        return true;
    }


    public function rename($university_id, $id, $full_name, $short_name)
    {
        $department = Department::where('id', $id)->first();
        if (!$department)
            return false;
        $faculty = Faculty::where('id', $department->faculty_id)->where('university_id', $university_id)->first();
        if (!$faculty)
            return false;
        $department->full_name = $full_name;
        $department->short_name = $short_name;
        $department->save();

        return true;
    }


    public function is_department_in_university($department_id, $university_id)
    {
        $department = DB::table('departments')->
            join('faculties', 'departments.faculty_id', '=', 'faculties.id')->
            join('universities', 'faculties.university_id', '=', 'universities.id')->
            where('departments.id', $department_id)->where('universities.id', $university_id)->
            first();

        if (!$department)
            return false;
        return true;
    }
}
