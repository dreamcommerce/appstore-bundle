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

    public function __construct(\ArrayObject $collection){

        $this->collection = $collection;
    }

    public function getListOfField($fieldName){

        $result = array();

        foreach($this->collection as $item){
            if(!isset($item[$fieldName])){
                //todo: exception
                return false;
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
                    // todo: narrower exception
                    throw new \Exception();
                }

                $result[$i[$key]] = $i;
            }else{
                $result[] = $i;
            }
        }

        return $result;
    }

}