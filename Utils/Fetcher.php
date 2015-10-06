<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-04-01
 * Time: 14:18
 */

namespace DreamCommerce\ShopAppstoreBundle\Utils;


use DreamCommerce\Resource;
use DreamCommerce\ShopAppstoreBundle\Utils\Fetcher\ResourceListIterator;

class Fetcher {

    /**
     * @var Resource
     */
    protected $resource;

    public function __construct(Resource $resource){
        $this->resource = $resource;
    }

    /**
     * @return ResourceListIterator
     * @throws \DreamCommerce\Exception\ResourceException
     */
    public function fetchAll(){
        return new ResourceListIterator($this->resource);
    }

    /**
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