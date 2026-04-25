<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'registrations';

    protected $fillable = [
        'event_id',
        'team_id',
        'name',
        'no_wa',
        'email',
        'bukti_tf',
        'status',
        'expired_at'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
