<?php

namespace modules\core\components;

/**
 * Class StorageManager
 * @package modules\budget\components
 */
class StorageManager extends AbstractService
{
    /**
     * @var string
     */
    public $storageUrl;

    /**
     * @param string $fileUri
     * @return string
     */
    public function getAbsoluteUrl($fileUri)
    {
        return $this->normalizeStorageUrl(). '/' . ltrim($fileUri, '/');
    }

    /**
     * @return string
     */
    private function normalizeStorageUrl()
    {
        return rtrim($this->storageUrl, '/');
    }
}