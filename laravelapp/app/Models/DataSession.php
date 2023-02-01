<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $session_id
 */

class DataSession extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'session_id',
        'data',
    ];

    public function session(){
        return $this->belongsTo(Session::class);
    }
}
