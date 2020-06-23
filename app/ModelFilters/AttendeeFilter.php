<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class AttendeeFilter extends ModelFilter
{
    /**
     * @param $first_name
     * @return AttendeeFilter
     */
    public function first_name($first_name)
    {
        return $this->where('first_name', 'LIKE', '%'.$first_name.'%');
    }

    /**
     * @param $last_name
     * @return AttendeeFilter
     */
    public function last_name($last_name)
    {
        return $this->where('last_name', 'LIKE', '%'.$last_name.'%');
    }

    /**
     * @param $email
     * @return AttendeeFilter
     */
    public function email($email)
    {
        return $this->where('email', 'LIKE', '%'.$email.'%');
    }

    /**
     * @param $phone_number
     * @return AttendeeFilter
     */
    public function phone_number($phone_number)
    {
        return $this->where('phone_number', 'LIKE', '%'.$phone_number.'%');
    }
}
