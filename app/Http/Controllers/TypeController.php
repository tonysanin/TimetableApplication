<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\Type;
use App\University;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TypeController extends BaseController
{
    public function create($university_id, $full_name, $short_name)
    {
        // Returns type id
        $type = new Type();
        return $type->create($university_id, $full_name, $short_name);
    }


    public function get_types($university_id)
    {
        return Type::where('university_id', $university_id)->get();
    }


    public function type_exists($id, $university_id)
    {
        $type = Type::where('id', $id)->where('university_id', $university_id)->first();
        if (!$type)
            return false;
        return true;
    }


    public function delete_type($id)
    {
        $type = Type::where('id', $id)->first();
        if ($type) {
            $type->delete();
            return true;
        }
        return false;
    }


    public function rename($university_id, $id, $full_name, $short_name)
    {
        $type = Type::where('id', $id)->where('university_id', $university_id)->first();
        if (!$type)
            return false;
        $type->full_name = $full_name;
        $type->short_name = $short_name;
        $type->save();

        return true;
    }

}
