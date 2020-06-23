<?php

namespace App\Services\Talk;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UpdateService
{
    const UPDATE_FIELDS = ['title', 'address', 'talk_date', 'start_time', 'end_time', 'description'];
    protected $data;
    protected $talk;

    /**
     * UpdateService constructor.
     * @param $data
     * @param $talk
     */
    public function __construct($data, $talk)
    {
        $this->data = $data;
        $this->talk = $talk;
    }

    public function run()
    {
        DB::transaction(function () {
            $this->updateModel(Arr::except($this->data, 'speakers'), $this->talk, self::UPDATE_FIELDS);
            $this->talk->speakers()->sync(Arr::pluck($this->data['speakers'], 'id'));
        });
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
