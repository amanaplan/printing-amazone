<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartArtworks extends Model
{
    protected $table = 'cart_artworks';
    protected $guarded = ['id'];

    public $timestamps = false;
}
