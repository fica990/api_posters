<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends BaseModel
{
    protected $fillable = ['name', 'path'];

    public function posters()
    {
        return $this->hasMany(Poster::class);
    }
}
