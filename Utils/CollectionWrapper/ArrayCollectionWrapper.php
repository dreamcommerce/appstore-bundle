<?php
namespace DreamCommerce\ShopAppstoreBundle\Utils\CollectionWrapper;

use \Traversable;

/**
 * Class CollectionWrapper
 *
 * adds some helper methods for fetched collection of arrays
 *
 * @package DreamCommerce\ShopAppstoreBundle\Utils
 */
class ArrayCollectionWrapper extends AbstractCollectionWrapper
{
    public function getListOfField($fieldName) : Traversable
    {
        $result = array();

        foreach($this->collection as $item){
            if(!isset($item[$fieldName])){
                throw new \InvalidArgumentException(sprintf('Non-existing key: %s', $fieldName));
            }

            $result[] = $item[$fieldName];
        }

        return new \ArrayObject($result);
    }

    public function getArray($key = null): array {
        return $this->collectionToAssoc($key);
    }

    public function getCollectionsArray($key): Traversable {
        return new \ArrayObject($this->collectionToAssoc($key, true));
    }

    /**
     * internal collection to associative array transformer
     *
     * @param string|null $key
     * @param bool|false $collection - forces every key to be an array
     * @return array
     */
    protected function collectionToAssoc($key = null, $collection = false) {
        $result = array();
        foreach($this->collection as $i){
            if($key) {
                if(!isset($i[$key])){
                    throw new \InvalidArgumentException(sprintf('Collection filtering non-existing key: %s', $key));
                }

                $val = $i[$key];
                if($collection === true) {
                    if(!isset($result[$val])){
                        $result[$val] = [];
                    }

                    $result[$val][] = $i;
                } else {
                    $result[$val] = $i;
                }
            }else{
                $result[] = $i;
            }
        }

        return $result;
    }



}