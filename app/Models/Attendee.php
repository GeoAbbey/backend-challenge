<?php

namespace App\Models;

class Attendee extends Base
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function conferences()
    {
        return $this->belongsToMany(Conference::class);
    }
}
