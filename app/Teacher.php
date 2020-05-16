<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Teacher extends Model
{
    public $timestamps = false;
    protected $table = 'teachers';


    public function create($full_name, $short_name, $department_id)
    {
        // Returns new faculty id
        $teacher = new Teacher();
        $teacher->full_name = $full_name;
        $teacher->short_name = $short_name;
        $teacher->department_id = $department_id;
        $teacher->save();

        return $teacher->id;
    }
}
