<?php

namespace App\Models;

class TalkAsset extends Base
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function talk()
    {
        return $this->belongsTo(Talk::class);
    }
}
