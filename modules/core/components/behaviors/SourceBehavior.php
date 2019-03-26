<?php

namespace modules\core\components\behaviors;

use common\models\ScenarioSource;
use yii\base\Behavior;
use yii\db\ActiveRecord;


class SourceBehavior extends Behavior
{
    public $data;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'saveSource',
            ActiveRecord::EVENT_AFTER_UPDATE => 'saveSource',
        ];
    }

    public function saveSource()
    {
        if ($this->data['years']){
            $ids = $this->getIdsOfSavedSources($this->data['years'], $this->data['content'], $this->data['link']);
            ScenarioSource::deleteAll(['AND', ['scenario_id' => $this->owner->id], ['not in', 'id', $ids]]);
        }else{
            ScenarioSource::deleteAll(['scenario_id' => $this->owner->id]);
        }
    }

    public function getIdsOfSavedSources($years, $contents, $link)
    {
        $ids = [];
        foreach ($years as $id => $year){
            if (preg_match('#^[0-9]{4}#', $year)){
                if ($id > 0){
                    $this->updateSource($id, $year, $contents[$id], $link[$id]);
                    $ids[] = $id;
                    continue;
                }
                $ids[] = $this->getIdOfSavedSource($years[$id], $contents[$id], $link[$id]);
            }
        }
        return $ids;
    }

    public function updateSource($id, $year, $content, $link)
    {
        $source = ScenarioSource::find()->where(['id' => $id])->one();
        if ($source){
            $source->year = $year;
            $source->content = $content;
            $source->link = $link;
            $source->save();
        }
    }

    public function getIdOfSavedSource($year, $content, $link)
    {
        $source = new ScenarioSource();
        $source->scenario_id = $this->owner->id;
        $source->year = $year;
        $source->content = $content;
        $source->link = $link;
        $source->save();
        return $source->id;
    }
}