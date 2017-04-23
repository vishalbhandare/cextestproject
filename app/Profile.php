<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    public $fillable = ['name','email','profilepic','phonenumber'];

}
