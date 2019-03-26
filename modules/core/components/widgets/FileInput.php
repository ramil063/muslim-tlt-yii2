<?php

namespace modules\core\components\widgets;


class FileInput extends \kartik\file\FileInput
{
    public function init()
    {
        $this->pluginEvents = [
            'fileclear' => 'function (){
                if (typeof idClearImage_'.$this->attribute.' == "undefined"){                
                    var input = document.createElement("input");
                    input.setAttribute("type", "hidden");
                    input.setAttribute("id", "'.$this->attribute.'");
                    input.setAttribute("name", "IsClearImage['.$this->attribute.']");
                    input.setAttribute("value", 1);
                    this.appendChild(input);
                }else{
                    '.$this->attribute.'.value = 1;
                }
            }',
            'change' => 'function(){
                if (typeof idClearImage_'.$this->attribute.' != "undefined"){
                    idClearImage_'.$this->attribute.'.value = 0;
                }
            }',
        ];
        parent::init();
    }
}