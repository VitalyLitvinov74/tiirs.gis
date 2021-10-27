<?php


namespace vloop\gis\entities\locations;


use vloop\entities\contracts\Entity;
use vloop\entities\contracts\Form;
use vloop\entities\exceptions\NotFoundEntity;
use vloop\entities\exceptions\NotSavedData;
use vloop\gis\tables\LocationUsersTable;
use yii\db\ActiveRecord;

class LocationSQL implements Entity
{
    private $id;

    public function __construct(int $id) {
        $this->id = $id;
    }

    /**
     * @return string|int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return null|array|bool|LocationUsersTable|ActiveRecord
     * @throws NotFoundEntity
     */
    private function record(){
        static $record = false;
        if($record!==false){
            return $record;
        }
        $record = LocationUsersTable::find()->where(['id'=>$this->id()])->asArray()->one();
        if($record === null){
            throw new NotFoundEntity("Координаты пользователя не найдены");
        }
        return $record;
    }

    /**
     * @return array - печатает себя в виде массива
     * @throws NotFoundEntity
     */
    public function printYourself(): array
    {
        $print  = $this->record();
        unset($print['id']);
        return $print;
    }

    /**
     * @param Form $form - форма из которой следует брать провалидированные значения
     * @return Entity - возвращает себя же.
     * @throws NotFoundEntity
     * @throws \vloop\entities\exceptions\NotValidatedFields
     * @throws NotSavedData
     */
    public function changeLineData(Form $form): Entity
    {
        $record = $this->record();
        $record->setAttributes($form->validatedFields());
        if($record->save()){
            return $this;
        }
        throw new NotSavedData($record->getErrors(), 403);
    }

    /**
     * удаляет себя насовсем.
     */
    public function remove(): void
    {
        LocationUsersTable::deleteAll(['id'=>$this->id()]);
    }

    /**
     * Реализаует паттерн NullObject
     */
    public function isNull(): bool
    {
        return false;
    }
}