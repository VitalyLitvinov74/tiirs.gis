<?php


namespace vloop\gis\entities\locations;


use vloop\entities\contracts\Entities;
use vloop\entities\contracts\Entity;
use vloop\entities\contracts\Form;
use vloop\entities\exceptions\NotSavedData;
use vloop\gis\tables\LocationUsersTable;

class LocationsSQL implements Entities
{

    private function records(){
        $records = LocationUsersTable::find()->select(['id'])->asArray()->all();
        return $records;
    }

    /**
     * @return Entity[] - массив вида [id=>Entity]
     */
    public function list(): array
    {
        $list = [];
        foreach ($this->records() as $record){
            $list[$record['id']] = new LocationSQL($record['id']);
        }
        return $list;
    }

    /**
     * @param Form $form - форма, которая выдает провалидированные данные
     * @return Entity - Новая сущность которая только что была создана
     * @throws \vloop\entities\exceptions\NotValidatedFields
     * @throws NotSavedData
     */
    public function add(Form $form): Entity
    {
        $fields = $form->validatedFields();
        $record = new LocationUsersTable($fields);
        if($record->save()){
            return new LocationSQL($record->id);
        }
        throw new NotSavedData($record->getErrors(), 403);
    }

    /**
     * @param int $id
     * @return Entity - конкретная сущность из массив.
     */
    public function entity(int $id): Entity
    {
        return $this->list()[$id];
    }

    /**
     * Реализует паттерн NullObject
     */
    public function isNull(): bool
    {
        return false;
    }
}