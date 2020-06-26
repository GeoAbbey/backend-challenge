<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class SpeakerFilter extends ModelFilter
{
    public function name($name)
    {
        return $this->where('name', 'LIKE', '%'.$name.'%');
    }

    public function email($email)
    {
        return $this->where('email', 'LIKE', '%'.$email.'%');
    }

    public function phone_number($phone_number)
    {
        return $this->where('phone_number', 'LIKE', '%'.$phone_number.'%');
    }
}
