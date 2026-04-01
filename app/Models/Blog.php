<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Blog extends Model
{
    use HasUuids;

    protected $fillable = [
        'titre',
        'contenu',
        'categorie',
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'id_blog');
    }
}
