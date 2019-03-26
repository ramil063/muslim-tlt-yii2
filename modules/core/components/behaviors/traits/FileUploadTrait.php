<?php
/**
 * @author t1grok <t1grok.free@gmail.com> {@link http://t1grok.net}
 */

namespace modules\core\components\behaviors\traits;

use Yii;
use yii\helpers\ArrayHelper;

trait FileUploadTrait
{
    /**
     * @var string
     */
    public $clearKey = 'clearFiles';

    /**
     * Необходимо ли очищать файл
     *
     * @return bool
     */
    private function isAttributeClearNeed()
    {
        if (Yii::$app instanceof \yii\console\Application) {
            return false;
        }
        $clearFiles = Yii::$app->request->post($this->clearKey);
        return is_array($clearFiles) && ArrayHelper::getValue($clearFiles, $this->attribute);
    }

    /**
     * @return string
     */
    public function generateFileName()
    {
        return uniqid() . '.' . $this->file->extension;
    }

    /**
     * Получение url-пути к директории с файлами (без имени файла)
     *
     * @param $attribute
     * @return string
     */
    public function getUploadPathUrl($attribute)
    {
        if ($this->owner->isNewRecord) {
            return '';
        }
        $behavior = static::getInstance($this->owner, $attribute);
        $pathWithFileName = $behavior->resolvePath($behavior->fileUrl);
        $lastSlashPos = mb_strrpos($pathWithFileName, '/', null, 'utf8');
        $pathWithoutFileName = mb_substr($pathWithFileName, 0, $lastSlashPos, 'utf8');
        return $pathWithoutFileName;
    }
}