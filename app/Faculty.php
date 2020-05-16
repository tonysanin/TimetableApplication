<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Faculty extends Model
{
    public $timestamps = false;
    protected $table = 'faculties';


    public function create($university_id, $full_name, $short_name)
    {
        // Returns new faculty id
        $faculty = new Faculty();
        $faculty->full_name = $full_name;
        $faculty->short_name = $short_name;
        $faculty->university_id = $university_id;
        $faculty->save();

        return $faculty->id;
    }


}
