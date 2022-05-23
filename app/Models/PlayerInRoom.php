<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerInRoom extends Model
{
    use HasFactory;

    protected $table = 'player_in_rooms';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['roomID', 'playerID'];
}
