<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionData extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'session_id',
        'data',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }
}
