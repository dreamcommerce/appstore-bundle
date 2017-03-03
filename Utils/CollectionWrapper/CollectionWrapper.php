<?php
namespace DreamCommerce\ShopAppstoreBundle\Utils\CollectionWrapper;

use \Traversable;

interface CollectionWrapper
{
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
    public function getListOfField($fieldName): Traversable;

    /**
     * append $collection to end of $this->collection
     *
     * @param Traversable $collection
     * @return Traversable
     */
    public function appendCollection($collection): CollectionWrapper;

    /**
     * get $this->collection
     *
     * @return Traversable
     */
    public function getCollection(): Traversable;

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
    public function getArray($key = null): array;

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
    public function getCollectionsArray($key): Traversable;

    /**
     * convert collection to array, return identical copy of collection as array
     *
     * @return array
     */
    public function toArray(): array;
}