<?php

namespace App\Services\Conference;

use App\Models\Conference;

class StoreService
{
    protected $data;

    /**
     * StoreService constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        return Conference::create($this->data);
    }
}
