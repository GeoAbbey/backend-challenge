<?php

namespace App\Services\Conference;

use App\Models\Conference;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

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
        return DB::transaction(function () {
            $conference = Conference::create(Arr::except($this->data, 'talks'));
            foreach ($this->data['talks'] as $talk) {
                (new \App\Services\Talk\StoreService($conference, $talk))->run();
            }
            return $conference;
        });
    }
}
