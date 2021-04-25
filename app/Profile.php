<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //php15課題以下を追記
    protected $guarded = array('id');

    // 以下を追記
    public static $rules = array(
        'name' => 'required',
        'gender' => 'required',
        'hobby' => 'required',
        'introduction' => 'required',
      );
}
