<?php


namespace DreamCommerce\ShopAppstoreBundle\Utils\Fetcher;


use DreamCommerce\Resource;

/**
 * Class ResourceConnection describes connection between two resources for bulk fetching
 * @package DreamCommerce\ShopAppstoreBundle\Utils\Fetcher
 */
class ResourceConnection
{
    /**
     * @var Resource
     */
    protected $resource;
    /**
     * @var string
     */
    protected $selfKey;
    /**
     * @var string|null
     */
    protected $foreignKey;

    /**
     * @var string
     */
    protected $class;
    /**
     * @var array
     */
    protected $filters;

    /**
     * @param Resource|Resource $resource
     * @param string $selfKey
     * @param string|null $foreignKey
     * @param array $filters
     */
    public function __construct(Resource $resource, $selfKey, $foreignKey = null, $filters = [])
    {
        $this->resource = $resource;
        $this->selfKey = $selfKey;
        $this->foreignKey = $foreignKey;

        $this->class = $this->getClassName($resource);
        $this->filters = $filters;
    }

    /**
     * @return Resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @return string
     */
    public function getSelfKey()
    {
        return $this->selfKey;
    }

    /**
     * @return string
     */
    public function getForeignKey()
    {
        if(empty($this->foreignKey)){
            return $this->getSelfKey();
        }
        return $this->foreignKey;
    }

    /**
     * get Shoper class name without DQN
     * @param $resource
     * @return string
     */
    protected function getClassName($resource)
    {
        $key = get_class($resource);
        $key = substr($key, strrpos($key, '\\')+1);
        return $key;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

}