<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderArtwork extends Model
{
    protected $table = 'order_artworks';
    protected $guarded = ['id'];

    public $timestamps = false;
}
