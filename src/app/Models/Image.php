<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends BaseModel
{
    protected $fillable = ['name', 'path', 'is_poster'];

    protected $casts = [
        'is_poster' => 'boolean'
    ];

    public function posters()
    {
        return $this->hasMany(Poster::class);
    }
}
