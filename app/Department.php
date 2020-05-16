<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Department extends Model
{
    public $timestamps = false;
    protected $table = 'departments';


    public function create($faculty_id, $full_name, $short_name)
    {
        // Returns new faculty id
        $department = new Department();
        $department->full_name = $full_name;
        $department->short_name = $short_name;
        $department->faculty_id = $faculty_id;
        $department->save();

        return $department->id;
    }


}
