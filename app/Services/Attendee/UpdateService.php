<?php

namespace App\Services\Attendee;

use Illuminate\Support\Arr;

class UpdateService
{
    const UPDATE_FIELDS = ['first_name', 'last_name', 'email', 'phone_number', 'address'];
    protected $attendee;
    protected $data;

    public function __construct($attendee, $data)
    {
        $this->attendee = $attendee;
        $this->data = $data;
    }

    /**
     * Run an update on the model
     */
    public function run()
    {
        return $this->updateModel($this->data, $this->attendee, self::UPDATE_FIELDS);
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
