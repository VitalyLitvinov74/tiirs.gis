<?php


namespace vloop\gis\controllers;


use vloop\entities\decorators\CachedEntities;
use vloop\entities\decorators\exceptions\HandledExceptionsOfEntities;
use vloop\entities\decorators\rest\jsonapi\JsonApiOfEntities;
use vloop\gis\entities\forms\input\AddLocation;
use vloop\gis\entities\locations\LocationsSQL;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\rest\Controller;

class LocationController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['?'], //на время разработки
                ],
            ],
        ];
        return $behaviors;
    }

    public function actionAddLocation()
    {
        $locations =
            new JsonApiOfEntities(
                new HandledExceptionsOfEntities(
                    new CachedEntities(
                        new LocationsSQL()
                    )
                ),
                'location'
            );
        return $locations
            ->add(new AddLocation())
            ->printYourself();
    }
}