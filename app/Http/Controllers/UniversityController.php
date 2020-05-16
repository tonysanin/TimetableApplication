<?php

namespace App\Http\Controllers;

use App\University;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UniversityController extends BaseController
{
    public function create($full_name, $short_name)
    {
        // Returns university id
        $university = new University();
        return $university->create($full_name, $short_name);
    }

    public function rename($id, $full_name, $short_name)
    {
        // Returns true/false if error
        $university = University::where('id', $id)->first();
        if (!$university)
            return false;
        $university->full_name = $full_name;
        $university->short_name = $short_name;
        $university->save();
        return true;
    }
}
