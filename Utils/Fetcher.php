<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-04-01
 * Time: 14:18
 */

namespace DreamCommerce\ShopAppstoreBundle\Utils;


use DreamCommerce\Resource;
use DreamCommerce\ShopAppstoreBundle\Utils\Fetcher\RelatedResourceListIterator;
use DreamCommerce\ShopAppstoreBundle\Utils\Fetcher\ResourceConnection;
use DreamCommerce\ShopAppstoreBundle\Utils\Fetcher\ResourceListIterator;

class Fetcher {

    /**
     * @var Resource
     */
    protected $resource;

    protected $connections = [];

    public function __construct(Resource $resource){
        $this->resource = $resource;
    }

    /**
     * @return ResourceListIterator
     * @throws \DreamCommerce\Exception\ResourceException
     */
    public function fetchAll(){

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