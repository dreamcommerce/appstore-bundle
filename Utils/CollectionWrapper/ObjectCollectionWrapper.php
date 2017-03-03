<?php
namespace DreamCommerce\ShopAppstoreBundle\Utils\CollectionWrapper;


use Traversable;

class ObjectCollectionWrapper extends AbstractCollectionWrapper
{
    public function getListOfField($property): Traversable
    {
        $accessorName = 'get'.ucfirst($property);

        $result = new \ArrayObject();
        foreach ($this->collection as $item) {
            $this->validObject($item, $accessorName);

            $result[] = $item->{$accessorName}();
        }

        return $result;
    }

    public function getArray($key = null): array
    {
        return $this->collectionToAssoc($key);
    }

    public function getCollectionsArray($key): Traversable
    {
        return $this->collectionToAssoc($key, true);
    }

    protected function collectionToAssoc($property = null, bool $collection = false)
    {
        if ($property) {
            $accessorName = 'get' . ucfirst($property);
        } else {
            $accessorName = null;
        }

        $result = new \ArrayObject();
        foreach($this->collection as $item){
            $this->validObject($item, $accessorName);

            if($property) {
                $propertyValue = $item->{$accessorName}();

                if($collection === true) {
                    if(!isset($result[$propertyValue])){
                        $result[$propertyValue] = [];
                    }

                    $result[$propertyValue][] = $item;
                } else {
                    $result[$propertyValue] = $item;
                }
            } else {
                $result[] = $item;
            }
        }

        return $result;
    }

    private function validObject($item, $accessorName)
    {
        if (!is_object($item)) {
            throw new \InvalidArgumentException('All items in collection must be objects');
        }

        if ($accessorName && !method_exists($item, $accessorName)) {
            throw new \InvalidArgumentException('Object has not property or has not method to read property');
        }
    }
}