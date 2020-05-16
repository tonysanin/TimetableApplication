<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class University extends Model
{
    public $timestamps = false;
    protected $table = 'universities';


    public function create($full_name, $short_name)
    {
        $university = new University();
        $university->full_name = $full_name;
        $university->short_name = $short_name;
        $university->save();

        return $university->id;
    }


}
