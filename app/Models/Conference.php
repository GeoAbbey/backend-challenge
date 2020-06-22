<?php

namespace App\Models;

class Conference extends Base
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function talks()
    {
        return $this->hasMany(Talk::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attendees()
    {
        return $this->belongsToMany(Attendee::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
