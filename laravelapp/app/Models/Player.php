<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $nickname
 */

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'nickname',
    ];
}
