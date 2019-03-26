<?php

namespace modules\core\components\behaviors;

use modules\core\components\behaviors\traits\FileUploadTrait;
use Yii;
use yii\web\UploadedFile;


class ImageUploadBehavior extends \yiidreamteam\upload\ImageUploadBehavior
{
    use FileUploadTrait;

    public function beforeSave()
    {
        parent::beforeSave();
        $postIsClearImage = Yii::$app->request->post('IsClearImage');
        if (is_array($postIsClearImage)){
            foreach ($postIsClearImage as $attribute => $IsClearImage){
                if ((bool)$IsClearImage){
                    $this->owner->setAttribute($attribute, null);
                }
            }
        }
        if ($this->file instanceof UploadedFile) {
            $this->owner->{$this->attribute} = uniqid() . '.' . $this->file->extension;
        }
    }
}