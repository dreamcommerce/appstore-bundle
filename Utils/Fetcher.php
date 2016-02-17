<?php
namespace DreamCommerce\ShopAppstoreBundle\Utils;


use DreamCommerce\ShopAppstoreLib\Resource;
use DreamCommerce\ShopAppstoreBundle\Utils\Fetcher\RelatedResourceListIterator;
use DreamCommerce\ShopAppstoreBundle\Utils\Fetcher\ResourceConnection;
use DreamCommerce\ShopAppstoreBundle\Utils\Fetcher\ResourceListIterator;

/**
 * Class Fetcher
 *
 * takes care of fetching data with records exceeding single page
 *
 * @package DreamCommerce\ShopAppstoreBundle\Utils
 */
class Fetcher {

    /**
     * fetched resource
     * @var Resource
     */
    protected $resource;

    /**
     * @var ResourceConnection[]
     */
    protected $connections = [];

    /**
     * @param Resource $resource
     */
    public function __construct(Resource $resource){
        $this->resource = $resource;
    }

    /**
     * fetches all data transparently
     * @return ResourceListIterator
     * @throws \DreamCommerce\Exception\ResourceException
     */
    public function fetchAll(){

        // if have we any connections?
        if($this->connections){
            return new RelatedResourceListIterator($this->resource, $this->connections);
        }

        return new ResourceListIterator($this->resource);
    }

    /**
     * add connection to the secondary resource
     * @param Resource|Resource $resource
     * @param string $self
     * @param string|null $foreign
     * @param array $filters
     */
    public function connect(Resource $resource, $self, $foreign = null, $filters = []){
        $this->connections[] = new ResourceConnection($resource, $self, $foreign, $filters);
    }

    /**
     * executes callback for each record from collection, callback param - record
     * @param callable $callback
     * @throws \DreamCommerce\Exception\ResourceException
     */
    public function walk(Callable $callback){
        $page = 1;
        do{
            /**
             * @var $objects \ArrayObject
             */
            $objects = $this->resource->page($page)->get();
            foreach($objects as $o){
                $callback($o);
            }

            $page++;
        }while($objects->page < $objects->pages);
    }


}