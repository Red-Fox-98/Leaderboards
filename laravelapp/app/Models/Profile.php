<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $last_name
 * @property string $name
 * @property string $middle_name
 */

class Profile extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'last_name',
        'name',
        'middle_name',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
