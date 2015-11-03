<?php


namespace DreamCommerce\ShopAppstoreBundle\Utils\Fetcher;


use DreamCommerce\Resource;
use DreamCommerce\ShopAppstoreBundle\Utils\CollectionWrapper;
use DreamCommerce\ShopAppstoreBundle\Utils\Fetcher;

/**
 * Class ResourceListIterator. Helps doing stuff on auto-lazy-load
 * larger (>1 page) collections
 *
 * @package DreamCommerce\ShopAppstoreBundle\Utils\Fetcher
 */
class RelatedResourceListIterator extends ResourceListIterator
{

    /**
     * @var ResourceConnection[]
     */
    protected $connections = [];

    protected $resData = [];

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

        $primaryKeys = $this->getPrimaryKeys($this->collection, $this->connections);

        $this->resData = $this->fetchRelatedData($primaryKeys, $this->connections);

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
                $primaryKeys[$c->getClass()][] = $i->{$c->getSelfKey()};
            }
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
        $resData = [];

        if(empty($primaryKeys)){
            return $resData;
        }

        foreach($connections as $connection){
            $resource = $connection->getResource();

            $filters = [
                $connection->getSelfKey()=>[
                    'in'=>array_values($primaryKeys[$connection->getClass()])
                ]
            ];

            $filters = array_merge($filters, $connection->getFilters());

            $result = $resource->filters($filters);

            $fetcher = new Fetcher($result);
            $items = $fetcher->fetchAll();
            $wrapper = new CollectionWrapper($items);

            $class = $connection->getClass();
            $resData[$class] = $wrapper->getCollectionsArray($connection->getForeignKey());
        }

        return $resData;
    }

    /**
     * decorates current row with related data
     * @param mixed $row
     * @return mixed
     */
    protected function transformRow($row){

        if($row===null || is_scalar($row)){
            return $row;
        }

        foreach($this->connections as $data){
            $self = $row->{$data->getSelfKey()};
            $class = $data->getClass();
            if(isset($this->resData[$class][$self])){
                $row->{$class} = $this->resData[$class][$self];
            }else{
                $row->{$class} = [];
            }
        }

        return $row;
    }

}