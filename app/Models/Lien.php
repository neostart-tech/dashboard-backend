<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Lien extends Model
{
    use HasUuids;

    protected $fillable = [
        'instagram',
        'facebook',
        'x',
        'tiktok',
    ];
}
