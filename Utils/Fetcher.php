<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-04-01
 * Time: 14:18
 */

namespace DreamCommerce\ShopAppstoreBundle\Utils;


use DreamCommerce\Resource;

class Fetcher {

    /**
     * @var Resource
     */
    protected $resource;

    public function __construct(Resource $resource){

        $this->resource = $resource;
    }

    /**
     * @return \ArrayObject
     * @throws \DreamCommerce\Exception\ResourceException
     */
    public function fetchAll(){
        $result = array();

        $page = 1;
        do{
            /**
             * @var $objects \ArrayObject
             */
            $objects = $this->resource->page($page)->get();
            $result = array_merge($result, $objects->getArrayCopy());

            $page++;
        }while($objects->page < $objects->pages);

        $object = new \ArrayObject($result);
        return $object;
    }


}