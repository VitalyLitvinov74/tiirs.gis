<?php


namespace vloop\gis\entities\forms\input;


use vloop\entities\yii2\AbstractForm;

class AddLocation extends AbstractForm
{
    public $longitude_x;
    public $latitude_y;
    public $time;
    public $user_id;

    public function rules()
    {
        return [
            [['user_id', 'longitude_x', 'latitude_y', 'time'], 'required'],
            [['user_id', 'time'], 'integer'],
            [['longitude_x', 'latitude_y'], 'number']
        ];
    }
}