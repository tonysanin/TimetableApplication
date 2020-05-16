<?php

namespace App\Http\Controllers;

use App\Auditory;
use App\Group;
use App\Teacher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class GroupController extends BaseController
{
    public function create($name, $faculty_id)
    {
        // Returns new group id
        $group = new Group();
        return $group->create($name, $faculty_id);
    }


    public function get_all($university_id)
    {
        return DB::table('universities')->
        join('faculties', 'faculties.university_id', '=', 'universities.id')->
        join('groups', 'groups.faculty_id', '=', 'faculties.id')->
        where('universities.id', $university_id)->
        select('groups.*')->get();
    }


    public function group_exists($university_id, $id)
    {
        $group = DB::table('universities')->
        join('faculties', 'faculties.university_id', '=', 'universities.id')->
        join('groups', 'groups.faculty_id', '=', 'faculties.id')->
        where('universities.id', $university_id)->
        where('groups.id', $id)->
        select('groups.*')->first();

        if (!$group)
            return false;
        return true;
    }


    public function delete($id)
    {
        $group = Group::where('id', $id)->first();

        if (!$group)
            return false;

        $group->delete();
        return true;
    }


    public function rename($id, $name)
    {
        $group = Group::where('id', $id)->first();

        if (!$group)
            return false;

        $group->name = $name;
        $group->save();
        return true;
    }
}
