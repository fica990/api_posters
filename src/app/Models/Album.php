<?php

namespace App\Models;

class Album extends BaseModel
{
    protected $fillable = ['name'];

    public function posters()
    {
        return $this->hasMany(Poster::class);
    }
}
