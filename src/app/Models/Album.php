<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends BaseModel
{
    protected $fillable = ['name'];

    public function posters()
    {
        return $this->hasMany(Poster::class);
    }
}
