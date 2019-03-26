<?php

namespace modules\core\backend\components\acl;

use Yii;
use yii\rbac\CheckAccessInterface;

use common\models\ResourceMap;
use common\models\Resource;

class DbManager implements CheckAccessInterface
{
    /**
     * Разрешенные ресурсы
     * @var array
     */
    private $resources;

    /**
     * Авторизованный пользователь
     * @var integer
     */
    private $identity;

    /**
     * @param int|string $userId
     * @param string $permissionName
     * @param array $params
     * @return bool
     */
    public function checkAccess($userId, $permissionName, $params = [])
    {
//        if(null === $this->identity){
//            $this->identity = Yii::$app->user->getIdentity();
//        }
//
//        if(null === $this->resources){
//            $this->resources = $this->loadResources($this->identity->user_role_id);
//        }
//
//        $access = $this->normalizeAccessPermission($permissionName);
        return true;//$this->check($this->resources, $access);
    }

    /**
     * @param string $permissionName
     * @return array
     */
    protected function normalizeAccessPermission($permissionName)
    {
        $access = [];
        if(strpos($permissionName, '.') !== false){
            $access = explode('.', $permissionName);
        }else{
            $access[] = $permissionName;
        }

        return $access;
    }

    /**
     * @param array $resources
     * @param array $access
     * @return bool
     */
    protected function check($resources, $access)
    {
        $accessResource = array_shift($access);
        if(!isset($resources[$accessResource])){
            return false;
        }

        if(empty($access)){
            return true;
        }
        return $this->check($resources[$accessResource], $access);
    }

    /**
     * @param integer $roleId
     * @return array
     */
    protected function loadResources($roleId)
    {
        $resources = Resource::find()
            ->innerJoin(ResourceMap::tableName(), 'resource_map.resource_id = resource.id')
            ->where('resource_map.user_role_id = :role_id', ['role_id' => $roleId])
            ->orderBy(['resource.resource_type_id' => SORT_ASC, 'resource.parent_id' => SORT_ASC])
            ->all();

        return $this->getResourceTree($resources);
    }

    /**
     * @param array $resources
     * @param null|integer $parentId
     * @return array
     */
    protected function getResourceTree($resources, $parentId = null)
    {
        $items = [];
        $itemsCount = count($resources);
        for($resourceIndex = 0; $resourceIndex < $itemsCount; $resourceIndex++){
            $resource = $resources[$resourceIndex];
            if($parentId == $resource->parent_id){
                $nodes = $this->getResourceTree($resources, $resource->id);
                $items[$resource->code] = $nodes;
            }
        }

        return $items;
    }
}