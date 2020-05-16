<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Api extends Model
{
    public $timestamps = false;
    protected $table = 'api_keys';


    public function key_exists($api)
    {
        $key = Api::where('api_key', $api)->first();
        if (!$key)
            return false;
        return true;
    }

    public function set_university($api, $id)
    {
        $key = Api::where('api_key', $api)->first();
        if (!$key)
            return false;
        $key->university_id = $id;
        $key->save();
        return true;
    }

    public function get_university_id($api)
    {
        $key = Api::where('api_key', $api)->first();
        if (!$key)
            return null;
        return $key->university_id;
    }


}
