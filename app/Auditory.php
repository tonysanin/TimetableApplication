<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Auditory extends Model
{
    public $timestamps = false;
    protected $table = 'auditories';


    public function create($university_id, $name)
    {
        // Returns new auditory id
        $auditory = new Auditory();
        $auditory->name = $name;
        $auditory->university_id = $university_id;
        $auditory->save();

        return $auditory->id;
    }


}
