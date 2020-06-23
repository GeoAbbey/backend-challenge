<?php

namespace App\Services\Conference;

use Illuminate\Support\Arr;

class UpdateService
{
    const UPDATE_FIELDS = ['theme', 'address', 'start_date', 'end_date'];
    protected $conference;
    protected $data;

    /**
     * UpdateService constructor.
     * @param $conference
     * @param $data
     */
    public function __construct($conference, $data)
    {
        $this->conference = $conference;
        $this->data = $data;
    }

    public function run()
    {
        return $this->updateModel($this->data, $this->conference, self::UPDATE_FIELDS);
    }

    /**
     * @param $data
     * @param $model
     * @param $update_fields
     */
    protected function updateModel($data, $model, $update_fields)
    {
        foreach ($update_fields as $key) {
            if (Arr::has($data, $key)) {
                $model->setAttribute($key, $data[$key]);
            }
        }
        //save will only actually save if the model has changed
        $model->save();
    }
}
