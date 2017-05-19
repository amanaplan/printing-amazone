<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emailauth extends Model
{
    protected $table = 'email_authentication';
    protected $guarded = ['id'];
}
