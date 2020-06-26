<?php

namespace App\Services\Talk;

use Illuminate\Support\Arr;

class StoreService
{
    protected $conference;
    protected $data;

    /**
     * StoreService constructor.
     * @param $conference
     * @param $data
     */
    public function __construct($conference, $data)
    {
        $this->conference = $conference;
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $talk = $this->conference->talks()->create(Arr::except($this->data, 'speakers'));
        $talk->speakers()->attach(Arr::pluck($this->data['speakers'], 'id'));
        return $talk;
    }
}
