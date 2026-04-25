<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'quota_total',
        'team_limit',
        'max_member_per_team',
        'status'
    ];

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function registrations()
    {
        return $this->hasManyThrough(Registration::class, Team::class);
    }
}
