<?php

namespace App\Http\Controllers;

use App\Auditory;
use App\Group;
use App\Subject;
use App\Teacher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class SubjectController extends BaseController
{
    public function create($full_name, $short_name, $university_id)
    {
        // Returns new subject id
        $subject = new Subject();
        return $subject->create($full_name, $short_name, $university_id);
    }


    public function get_all($university_id)
    {
        return DB::table('universities')->
        join('subjects', 'subjects.university_id', '=', 'universities.id')->
        select('subjects.*')->where('universities.id', $university_id)->get();
    }


    public function subject_exists($university_id, $id)
    {
        $subject = DB::table('universities')->
        join('subjects', 'subjects.university_id', '=', 'universities.id')->
        select('subjects.*')->where('universities.id', $university_id)->
        where('subjects.id', $id)->first();

        if (!$subject)
            return false;

        return true;
    }


    public function delete($id)
    {
        $subject = Subject::where('id', $id)->first();

        if (!$subject)
            return false;

        $subject->delete();

        return true;
    }


    public function rename($id, $full_name, $short_name)
    {
        $subject = Subject::where('id', $id)->first();

        if (!$subject)
            return false;

        $subject->full_name = $full_name;
        $subject->short_name = $short_name;
        $subject->save();

        return true;
    }
}
