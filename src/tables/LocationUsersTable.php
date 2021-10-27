<?php


namespace vloop\gis\tables;


use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property int $user_id [int(11)]
 * @property float $longitude_x [float]
 * @property float $latitude_y [float]
 * @property int $time [int(11)]
 * Class LocationUsers
 * @package vloop\gis\tables
 */
class LocationUsersTable extends ActiveRecord
{
    public static function tableName()
    {
        return 'vloop_location_users';
    }
}