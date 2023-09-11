<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property int $user_id
 * @property string $nickname
 */

class Player extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'nickname',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function session(){
        return $this->hasOne(Session::class);
    }
}
