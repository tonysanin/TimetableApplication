<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Group extends Model
{
    public $timestamps = false;
    protected $table = 'groups';


    public function create($name, $faculty_id)
    {
        // Returns new faculty id
        $group = new Group();
        $group->name = $name;
        $group->faculty_id = $faculty_id;
        $group->save();

        return $group->id;
    }
}
