<?php

namespace App\Models;

class Speaker extends Base
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function talks()
    {
        return $this->belongsToMany(Talk::class);
    }
}
