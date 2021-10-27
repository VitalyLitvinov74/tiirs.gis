<?php


namespace vloop\gis;


use yii\base\Module;

class GisModule extends Module
{
    function init()
    {
        parent::init();
        $this->controllerNamespace = 'vloop\gis\controllers';
    }
}