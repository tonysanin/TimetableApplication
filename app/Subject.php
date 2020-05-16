<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Subject extends Model
{
    public $timestamps = false;
    protected $table = 'subjects';


    public function create($full_name, $short_name, $university_id)
    {
        // Returns new subject id
        $subject = new Subject();
        $subject->full_name = $full_name;
        $subject->short_name = $short_name;
        $subject->university_id = $university_id;
        $subject->save();

        return $subject->id;
    }
}
