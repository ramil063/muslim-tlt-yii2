<?php

namespace modules\core\components\behaviors;

use modules\core\components\behaviors\traits\FileUploadTrait;
use yii\web\UploadedFile;

class FileUploadBehavior extends \yiidreamteam\upload\FileUploadBehavior
{
    use FileUploadTrait;

    /**
     *
     */
    public function beforeSave()
    {
        parent::beforeSave();

        if ($this->isAttributeClearNeed()) {
            $this->owner->setAttribute($this->attribute, null);
        }
        if ($this->file instanceof UploadedFile) {
            $this->owner->{$this->attribute} = $this->generateFileName();
        }
    }
}