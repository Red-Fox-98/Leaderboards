<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'model_id',
        'model_type',
        'name',
        'type',
        'extension',
        'size',
        'published_at',
        'path',
    ];
}
