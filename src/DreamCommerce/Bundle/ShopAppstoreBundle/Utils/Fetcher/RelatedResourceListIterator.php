<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Utils\Fetcher;


use DreamCommerce\ShopAppstoreLib\Resource;
use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\CollectionWrapper\ArrayCollectionWrapper;
use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\Fetcher;

/**
 * Class ResourceListIterator.
 *
 * Helps doing stuff on auto-lazy-load larger (>1 page) collections
 *
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Utils\Fetcher
 */
class RelatedResourceListIterator extends ResourceListIterator
{

    /**
     * related connections
     * @var ResourceConnection[]
     */
    protected $connections = [];

    /**
     * connected resources keys
     * @var array
     */
    protected $relatedData = [];

    /**
     * @param Resource $resource
     * @param array $connections array with connections definitions
     */
    public function __construct(Resource $resource, $connections = [])
    {
        parent::__construct($resource);
        $this->connections = $connections;
    }

    /**
     * fetches collection for particular page
     * @param $page
     * @throws \DreamCommerce\Exception\ResourceException
     */
    protected function fetch($page){
        parent::fetch($page);

        // get primary keys values
        $primaryKeys = $this->getPrimaryKeys($this->collection, $this->connections);

        // related resources data
        $this->relatedData = $this->fetchRelatedData($primaryKeys, $this->connections);

        $this->iterator->rewind();

    }

    /**
     * get primary keys of related collections
     * @param \Traversable $collection
     * @param array $connections
     * @return array
     */
    protected function getPrimaryKeys(\Traversable $collection, array $connections){
        $primaryKeys = [];

        // gather keys
        foreach($collection as $i){
            foreach($connections as $key=>$c){
                /**
                 * @var $c ResourceConnection
                 */
                $class = $c->getClassName();
                $key = $i->{$c->getSelfKey()};

                $primaryKeys[$class][] = $key;
            }
        }

        // remove redundant keys
        foreach($primaryKeys as &$v){
            $v = array_unique($v);
        }

        return $primaryKeys;
    }

    /**
     * fetch related data collection
     * @param $primaryKeys
     * @param ResourceConnection[] $connections
     * @return \ArrayObject array
     */
    protected function fetchRelatedData($primaryKeys, $connections)
    {
        // get related collections
        $resourcesData = [];

        // no related keys, no fetching
        if(empty($primaryKeys)){
            return $resourcesData;
        }

        foreach($connections as $connection){
            $resource = $connection->getResource();

            // get current page related values keys
            $filters = [
                $connection->getSelfKey()=>[
                    'in'=>array_values($primaryKeys[$connection->getClassName()])
                ]
            ];

            // merge additional conditions on filters
            $filters = array_merge($filters, $connection->getFilters());

            // apply filters on resource
            $resource->filters($filters);

            // fetch collection for iteration
            $fetcher = new Fetcher($resource);
            $items = $fetcher->fetchAll();
            $wrapper = new ArrayCollectionWrapper($items);

            // inject connections data
            $class = $connection->getClassName();
            $resourcesData[$class] = $wrapper->getCollectionsArray($connection->getForeignKey());
        }

        return $resourcesData;
    }

    /**
     * decorates current row with related data
     * @param mixed $row
     * @return mixed
     */
    protected function transformRow($row){

        // if nothing to do
        if($row===null || is_scalar($row)){
            return $row;
        }

        foreach($this->connections as $data){
            // get self value
            $self = $row->{$data->getSelfKey()};

            $class = $data->getClassName();

            // if data isset - inject into key
            if(isset($this->relatedData[$class][$self])){
                $row->{$class} = $this->relatedData[$class][$self];
            // or inject empty value
            }else{
                $row->{$class} = [];
            }
        }

        return $row;
    }

}