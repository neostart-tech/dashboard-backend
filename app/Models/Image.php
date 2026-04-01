<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Image extends Model
{
    use HasUuids;

    protected $fillable = [
        'path',
        'id_blog',
        'is_couverture',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'id_blog');
    }
}
