<?php

namespace App\Models;

use EloquentFilter\Filterable;

class Conference extends Base
{
    use Filterable;
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
