<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyXp extends Model
{
    protected $fillable = ['user_id', 'xp_earned'];
public function user() { return $this->belongsTo(User::class); }
}
