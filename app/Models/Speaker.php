<?php

namespace App\Models;

use EloquentFilter\Filterable;

class Speaker extends Base
{
    use Filterable;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function talks()
    {
        return $this->belongsToMany(Talk::class);
    }
}
