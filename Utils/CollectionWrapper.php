<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-04-01
 * Time: 14:36
 */

namespace DreamCommerce\ShopAppstoreBundle\Utils;


use Symfony\Component\Config\Definition\Exception\Exception;

class CollectionWrapper {

    /**
     * @var \ArrayObject
     */
    protected $collection;

    public function __construct(\Traversable $collection){

        $this->collection = $collection;
    }

    public function getListOfField($fieldName){

        $result = array();

        foreach($this->collection as $item){
            if(!isset($item[$fieldName])){
                throw new \InvalidArgumentException(sprintf('Non-existing key: %s', $fieldName));
            }

            $result[] = $item[$fieldName];
        }

        return $result;

    }

    public function getArray($key = null){
        $result = array();
        foreach($this->collection as $i){
            if($key) {
                if(!isset($i[$key])){
                    throw new \InvalidArgumentException(sprintf('Collection filtering non-existing key: %s', $key));
                }

                $result[$i[$key]] = $i;
            }else{
                $result[] = $i;
            }
        }

        return $result;
    }

}