<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Utils\Fetcher;


use DreamCommerce\ShopAppstoreLib\Resource;

/**
 * Class ResourceConnection
 *
 * describes connection between two resources for bulk fetching
 *
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Utils\Fetcher
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
     * @param string|null $foreignKey if null - copies selfKey
     * @param array $filters
     */
    public function __construct(Resource $resource, $selfKey, $foreignKey = null, $filters = [])
    {
        $this->resource = $resource;
        $this->selfKey = $selfKey;
        $this->foreignKey = $foreignKey;

        $this->class = $this->transformClassName($resource);
        $this->filters = $filters;
    }

    /**
     * get foreign resource class
     * @return Resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * get self key name
     * @return string
     */
    public function getSelfKey()
    {
        return $this->selfKey;
    }

    /**
     * get foreign key name
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
    protected function transformClassName($resource)
    {
        $key = get_class($resource);
        $key = substr($key, strrpos($key, '\\')+1);
        return $key;
    }

    /**
     * get resource class name
     * @return string
     */
    public function getClassName()
    {
        return $this->class;
    }

    /**
     * get defined filters
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

}