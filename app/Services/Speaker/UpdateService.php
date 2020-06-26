<?php

namespace App\Services\Speaker;

use Illuminate\Support\Arr;

class UpdateService
{
    const UPDATE_FIELDS = ['name', 'email', 'phone_number', 'address'];
    protected $speaker;
    protected $data;

    /**
     * UpdateService constructor.
     * @param $speaker
     * @param $data
     */
    public function __construct($speaker, $data)
    {
        $this->speaker = $speaker;
        $this->data = $data;
    }

    public function run()
    {
        return $this->updateModel($this->data, $this->speaker, self::UPDATE_FIELDS);
    }

    /**
     * @param $data
     * @param $model
     * @param $update_fields
     */
    public function updateModel($data, $model, $update_fields)
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
