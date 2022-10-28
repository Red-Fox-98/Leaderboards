<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $player_id
 * @property string $map_name
 * @property int $score
 * @property int $session_duration
 */

class Session extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'id',
        'player_id',
        'map_name',
        'score',
        'session_duration',
    ];

    public function player(){
        return $this->belongsTo(Player::class);
    }
}
