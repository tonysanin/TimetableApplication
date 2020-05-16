<?php

namespace App\Http\Controllers;

use App\Auditory;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AuditoryController extends BaseController
{
    public function create($university_id, $name)
    {
        // Returns new auditory id
        $auditory = new Auditory();
        return $auditory->create($university_id, $name);
    }


    public function get_auditories($university_id)
    {
        return Auditory::where('university_id', $university_id)->get();
    }


    public function auditory_exists($id, $university_id)
    {
        $auditory = Auditory::where('id', $id)->where('university_id', $university_id)->first();
        if (!$auditory)
            return false;
        return true;
    }


    public function delete($id)
    {
        $auditory = Auditory::where('id', $id)->first();
        if (!$auditory)
            return false;
        $auditory->delete();
        return true;
    }


    public function rename($university_id, $id, $name)
    {
        $auditory = Auditory::where('id', $id)->where('university_id', $university_id)->first();
        if (!$auditory)
            return false;
        $auditory->name = $name;
        $auditory->save();

        return true;
    }
}
