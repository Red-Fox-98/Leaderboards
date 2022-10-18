<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $player_id
 * @property string $map_name
 * @property int $score
 */

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'player_id',
        'map_name',
        'score',
    ];
}
