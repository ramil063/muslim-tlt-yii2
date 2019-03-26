<?php

namespace modules\core\components\behaviors;

use common\models\Relation;
use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * Class RelationBehavior
 * @package modules\core\components\behaviors
 */
class RelationBehavior extends Behavior
{
    /**
     * @var array
     */
    public $files = [];

    /**
     * @var
     */
    public $entity;

    /**
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'saveRelations',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'saveRelations',
        ];
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function getRelations($entity)
    {
        return $this->owner->hasMany($entity, ['id' => 'from_entity_id'])
            ->viaTable('relation', ['to_entity_id' => 'id'], function ($activeQuery) use ($entity) {
                $activeQuery->where([
                    'from_entity' => $this->getEntity(),
                    'to_entity' => $entity::className()
                ]);
            });
    }

    /**
     * @return string
     */
    public function getEntity()
    {
        $owner = $this->owner;
        return $owner::className();
    }

    public function getEntityForQuery($name)
    {
        $array = explode("\\", $name);
        $name = end($array);
        return str_replace(' ', '', 'common\\\\models\\\\ ' . $name);
    }

    /**
     *
     */
    public function saveRelations()
    {
        foreach ($this->entity as $key => $item) {
            $this->saveRelation($key, $item);
        }
    }

    /**
     * @param $entity
     * @param $entityData
     * @internal param $entityName
     */
    public function saveRelation($entity, $entityData)
    {
        $this->deleteRalations($entity);
        $items = $entityData;
        if ($items) {
            foreach ($items as $item) {
                $relation = new Relation();
                $relation->from_entity = $this->getEntity();
                $relation->from_entity_id = $this->owner->id;
                $relation->to_entity = $entity;
                $relation->to_entity_id = $item;
                $relation->save();
                $relation = new Relation();
                $relation->from_entity = $entity;
                $relation->from_entity_id = $item;
                $relation->to_entity = $this->getEntity();
                $relation->to_entity_id = $this->owner->id;
                $relation->save();
            }
        }
    }

    /**
     * @param $entity
     */
    public function deleteRalations($entity)
    {
        Relation::deleteAll([
            'to_entity_id' => $this->owner->id,
            'from_entity' => $entity,
            'to_entity' => $this->getEntity()
        ]);
        Relation::deleteAll([
            'from_entity_id' => $this->owner->id,
            'from_entity' => $this->getEntity(),
            'to_entity' => $entity
        ]);
    }
}