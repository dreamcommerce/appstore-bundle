<?php
namespace DreamCommerce\ShopAppstoreBundle\Utils\CollectionWrapper;


abstract class AbstractCollectionWrapper implements CollectionWrapper
{
    /**
     * @var \Traversable
     */
    protected $collection;

    /**
     * @param \Traversable $collection
     */
    public function __construct($collection) {
        if (!is_array($collection) && !($collection instanceof \Traversable)) {
            throw new \UnexpectedValueException('$collection must be instance of \Traversable or array');
        }

        if (is_array($collection)) {
            $collection = new \ArrayObject($collection);
        }

        $this->collection = $collection;
    }

    public function appendCollection($collection): \Traversable
    {

        $buff = [];
        foreach($this->collection as $i){
            $buff[] = $i;
        }

        $collection = new static($collection);

        foreach($collection->getCollection() as $i){
            $buff[] = $i;
        }

        $this->collection->exchangeArray($buff);
    }

    public function getCollection(): \Traversable
    {
        return $this->collection;
    }
}