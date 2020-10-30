<?php

namespace App\Models;

class Poster extends BaseModel
{
    protected $fillable = ['name', 'path', 'image_id', 'album_id'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
