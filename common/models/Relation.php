<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "relation".
 *
 * @property integer $id
 * @property string $from_entity
 * @property integer $from_entity_id
 * @property string $to_entity
 * @property integer $to_entity_id
 */
class Relation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_entity_id', 'to_entity_id'], 'integer'],
            [['from_entity', 'to_entity'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_entity' => 'From Entity',
            'from_entity_id' => 'From Entity ID',
            'to_entity' => 'To Entity',
            'to_entity_id' => 'To Entity ID',
        ];
    }


    /**
     * @param $fromEntity
     * @param $entityId
     * @return array
     */
    public static function getRelatedAlbum($fromEntity, $entityId)
    {
        $relation = static::find()
            ->where([
                'from_entity' => $fromEntity,
                'from_entity_id' => $entityId,
                'to_entity' => Album::class
            ])
            ->one();
        if ($relation) {
            return $relation->getAttribute('to_entity_id');
        }
        return null;
    }
}
