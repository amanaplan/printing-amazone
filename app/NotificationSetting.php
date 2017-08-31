<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
    protected $table = 'notificationsetting';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function scopeOfType($query, $type)
    {
    	return $query->where('type', $type);
    }

}
