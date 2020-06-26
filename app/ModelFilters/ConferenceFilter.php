<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ConferenceFilter extends ModelFilter
{
    /**
     * @param $theme
     * @return ConferenceFilter
     */
    public function theme($theme)
    {
        return $this->where('theme', $theme);
    }

    /**
     * @param $start_date
     * @return ConferenceFilter
     */
    public function start_date($start_date)
    {
        return $this->whereDate('start_date', $start_date);
    }

    /**
     * @param $end_date
     * @return ConferenceFilter
     */
    public function end_date($end_date)
    {
        return $this->whereDate('end_date', $end_date);
    }

    /**
     * @param $start_date
     * @param $end_date
     * @return ConferenceFilter
     */
    public function date($start_date, $end_date)
    {
        return $this->whereDate('start_date', '>', $start_date)
                    ->orWhereDate('end_date', '<', $end_date);
    }
}
