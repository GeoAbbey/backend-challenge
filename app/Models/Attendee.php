<?php

namespace App\Models;

use EloquentFilter\Filterable;

class Attendee extends Base
{
    use Filterable;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function conferences()
    {
        return $this->belongsToMany(Conference::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
