<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class _Class extends Model
{
    public $timestamps = false;
    protected $table = 'classes';


    public function create($subject_id, $auditory_id, $class_time_id, $group_id, $teacher_id, $type_id, $date)
    {
        // Returns new faculty id
        $class = new _Class();
        $class->subject_id = $subject_id;
        $class->auditory_id = $auditory_id;
        $class->class_time_id = $class_time_id;
        $class->group_id = $group_id;
        $class->teacher_id = $teacher_id;
        $class->type_id = $type_id;
        $class->date = $date;
        $class->save();

        return $class->id;
    }
}
