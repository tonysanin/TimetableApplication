<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\University;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FacultyController extends BaseController
{
    public function create($university_id, $full_name, $short_name)
    {
        // Returns faculty id
        $faculty = new Faculty();
        return $faculty->create($university_id, $full_name, $short_name);
    }


    public function get_all_university_faculties($university_id)
    {
        return Faculty::where('university_id', $university_id)->get();
    }


    public function faculty_exists($id, $university_id)
    {
        $faculty = Faculty::where('id', $id)->where('university_id', $university_id)->first();
        if (!$faculty)
            return false;

        return true;
    }


    public function delete($id, $university_id)
    {
        $faculty = Faculty::where('id', $id)->where('university_id', $university_id)->first();
        if (!$faculty)
            return false;
        $faculty->delete();

        return true;
    }


    public function rename($university_id, $id, $full_name, $short_name)
    {
        $faculty = Faculty::where('id', $id)->where('university_id', $university_id)->first();
        if (!$faculty)
            return false;
        $faculty->full_name = $full_name;
        $faculty->short_name = $short_name;
        $faculty->save();

        return true;
    }


    public function delete_all_faculties($university_id)
    {
        $faculties = Faculty::where('university_id', $university_id)->get();
        if (!$faculties)
            return false;

        foreach ($faculties as $faculty)
            $faculty->delete();

        return true;
    }


    public function get_faculty($university_id, $faculty_id)
    {
        return Faculty::where('university_id', $university_id)->where('id', $faculty_id)->get();
    }
}
