<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poster extends BaseModel
{
    protected $fillable = ['name', 'image_id', 'album_id'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
