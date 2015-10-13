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

    /**
     * @param \Traversable $collection
     */
    public function __construct(\Traversable $collection){

        $this->collection = $collection;
    }

    /**
     * get list of specific field from collection
     *
     * [key=1,field=1]
     * [key=2,field=1]
     *
     * result:
     *
     * [1,2]
     *
     * @param string $fieldName
     * @return array
     */
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

    /**
     * associative list from collection, eg.
     * row [primary_key=1, ...]
     * row [primary_key=2, ...
     *
     * calling getArray('primary_key') will result following associative array
     *
     * 1=>[...]
     * 2=>[...]
     *
     * @param string|null $key
     * @return array
     */
    public function getArray($key = null){
        return $this->collectionToAssoc($key);
    }

    /**
     * internal collection to associative array transformer
     *
     * @param string|null $key
     * @param bool|false $collection - forces every key to be an array
     * @return array
     */
    protected function collectionToAssoc($key = null, $collection = false){
        $result = array();
        foreach($this->collection as $i){
            if($key) {
                if(!isset($i[$key])){
                    throw new \InvalidArgumentException(sprintf('Collection filtering non-existing key: %s', $key));
                }

                if($collection && isset($result[$i[$key]])){
                    if(!is_array($result[$i[$key]])){
                        $result[$i[$key]] = [$result[$i[$key]]];
                    }

                    $result[$i[$key]][] = $i;
                }else {
                    $result[$i[$key]] = $collection ? [$i] : $i;
                }
            }else{
                $result[] = $i;
            }
        }

        return $result;
    }

    /**
     * fetches collection array to associative subarrays, eg:
     *
     * [key=1, val=1]
     * [key=1, val=2]
     *
     * results:
     * 1=>[
     *  [key=1, val=1]
     *  [key=1, val=2]
     * ]
     *
     * @param string $key
     * @return array
     */
    public function getCollectionsArray($key){
        return $this->collectionToAssoc($key, true);
    }

}