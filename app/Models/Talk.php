<?php

namespace App\Models;

class Talk extends Base
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function talk_assets()
    {
        return $this->hasMany(TalkAsset::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function speakers()
    {
        return $this->belongsToMany(Speaker::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attendees()
    {
        return $this->belongsToMany(Attendee::class);
    }
}
