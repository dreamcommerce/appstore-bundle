<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Utils\Fetcher;


use DreamCommerce\ShopAppstoreLib\Resource\Exception\ResourceException;
use DreamCommerce\ShopAppstoreLib\Resource;
use DreamCommerce\ShopAppstoreLib\ResourceList;

/**
 * Class ResourceListIterator.
 *
 * Helps doing stuff on auto-lazy-load larger (>1 page) collections
 *
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Utils\Fetcher
 */
class ResourceListIterator implements \Iterator, \Countable
{

    /**
     * resource which is used as source for collection data
     * @var Resource
     */
    protected $resource;

    /**
     * current page result
     * @var ResourceList
     */
    protected $collection;

    /**
     * internal cursor - record index
     * @var int
     */
    protected $cursor = 0;

    /**
     * current page cursor
     * @var int
     */
    protected $currentPage = 0;

    /**
     * current row storage
     * @var null|\ArrayObject
     */
    protected $row = null;

    /**
     * iterator on collection
     * @var null|\ArrayIterator
     */
    protected $iterator = null;

    /**
     * was the first result preloaded by count?
     * @var bool
     */
    protected $cached = false;

    /**
     * @param Resource $resource
     */
    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * return current row
     * @return \ArrayObject|null
     */
    public function current()
    {
        return $this->row;
    }

    /**
     * moves cursor further
     */
    public function next()
    {
        $this->iterator->next();
        $this->nextThing();
    }

    /**
     * handles lazy-loading logic
     * @return void
     */
    protected function nextThing()
    {
        if(!$this->iterator->valid()){

            if($this->collection->pages==$this->currentPage){
                $this->row = null;
                return;
            }else {
                $this->currentPage++;
                $this->fetch($this->currentPage);
            }
        }

        $this->row = $this->transformRow($this->iterator->current());

        $this->cursor++;
    }

    /**
     * transform data row
     * @param mixed $row
     * @return mixed
     */
    protected function transformRow($row){
        return $row;
    }

    /**
     * current record index
     * @return int
     */
    public function key()
    {
        return $this->cursor;
    }

    /**
     * tells if is there anything for look forward
     * @return bool
     */
    public function valid()
    {
        return (bool)$this->row;
    }

    /**
     * rewinds iterator and calls fetching
     */
    public function rewind()
    {
        // prevent second fetching if count method has been called
        if($this->cached){
            $this->cached = false;
            return;
        }

        $this->cursor = 0;
        $this->currentPage = 1;
        $this->fetch(0);
        $this->nextThing();
    }

    /**
     * fetches collection for particular page
     * @param $page
     * @throws ResourceException
     */
    protected function fetch($page){
        $resourceCopy = clone $this->resource;
        $resourceCopy->page($page);

        // save up the memory; GC hack?
        $this->collection = null;
        $this->iterator = null;

        try {
            $this->collection = $resourceCopy->get();
            // empty collection received
        }catch(Resource\Exception\NotFoundException $ex){
            $object = new \ArrayObject();
            $object->count = 0;
            $object->pages = 0;
            $object->page = 1;
            $this->collection = $object;
        }

        $this->iterator = new \ArrayIterator($this->collection);
        $this->iterator->rewind();

    }

    /**
     * Countable interface method
     * @return int
     */
    public function count()
    {
        if(!$this->collection){
            $this->rewind();
            $this->cached = true;
        }

        return $this->collection->count;
    }
}