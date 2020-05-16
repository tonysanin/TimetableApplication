<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Type extends Model
{
    public $timestamps = false;
    protected $table = 'types';


    public function create($university_id, $full_name, $short_name)
    {
        // Returns new faculty id
        $type = new Type();
        $type->full_name = $full_name;
        $type->short_name = $short_name;
        $type->university_id = $university_id;
        $type->save();

        return $type->id;
    }


}
