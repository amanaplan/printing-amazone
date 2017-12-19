<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresetNamePhotoSticker extends Model
{
    protected $table = 'preset_name_photo_sticker';
    protected $guarded = ['id'];

    public function stickertype()
    {
        return $this->belongsTo('App\StickerType', 'sticker_type', 'id');
    }

    public function quantity()
    {
        return $this->belongsTo('App\OptQty', 'quantity_id', 'id');
    }

}
