<?php

namespace common\widgets;

use Yii;

class Menu extends \yii\widgets\Menu
{
    public $encodeLabels = false;

    public $expandArrow = true;

    public $expandArrowTemplate = '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>';

    /**
     * @return void
     */
    public function init()
    {
        parent::init();

        $this->processPermissions($this->items);
        if($this->expandArrow){
            $this->preProcessing($this->items);
        }
    }

    /**
     * @param array $items
     */
    protected function preProcessing(&$items)
    {
        foreach($items as $key => $item){
            if($this->expandArrow){
                $items[$key]['label'] = ' <span>'.$items[$key]['label'].'</span>';
                if(!empty($item['items'])){
                    $items[$key]['label'] .= $this->expandArrowTemplate;
                }
            }
        }
    }

    /**
     * @inheritdoc
     */
    protected function processPermissions(&$items)
    {
        foreach($items as $key => $item){
            // Проверка прав на просмотр элемента меню
            if(isset($item['permissions'])){
                if(!Yii::$app->user->can($item['permissions'])){
                    unset($items[$key]);
                    continue;
                }
            }
            if(!empty($item['items'])){
                $this->processPermissions($items[$key]['items']);
            }
        }
    }

    /**
     * @param array $item
     * @return string
     */
    protected function renderItem($item)
    {
        if(isset($item['icon'])){
            $item['label'] = '<i class="'.$item['icon'].'"></i> '.$item['label'];
        }
        return parent::renderItem($item);
    }
}