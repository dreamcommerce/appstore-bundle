<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-04-01
 * Time: 14:36
 */

namespace DreamCommerce\ShopAppstoreBundle\Utils;


class CollectionWrapper {

    /**
     * @var \ArrayObject
     */
    protected $collection;

    public function __construct(\ArrayObject $collection){

        $this->collection = $collection;
    }

    public function getListOfField($fieldName){

        $result = array();

        foreach($this->collection as $item){
            if(!isset($item[$fieldName])){
                return false;
            }

            $result[] = $item[$fieldName];
        }

        return $result;

    }

}