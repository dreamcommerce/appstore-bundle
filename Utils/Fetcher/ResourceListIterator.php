<?php


namespace DreamCommerce\ShopAppstoreBundle\Utils\Fetcher;


use DreamCommerce\Resource;
use DreamCommerce\ResourceList;

/**
 * Class ResourceListIterator. Helps doing stuff on auto-lazy-load
 * larger (>1 page) collections
 *
 * @package DreamCommerce\ShopAppstoreBundle\Utils\Fetcher
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
        $this->cursor = 0;
        $this->currentPage = 1;
        $this->fetch(0);
        $this->nextThing();
    }

    /**
     * fetches collection for particular page
     * @param $page
     * @throws \DreamCommerce\Exception\ResourceException
     */
    protected function fetch($page){
        $resourceCopy = clone $this->resource;
        $resourceCopy->page($page);

        // save up the memory; GC hack?
        $this->collection = null;
        $this->iterator = null;

        $this->collection = $resourceCopy->get();
        $this->iterator = new \ArrayIterator($this->collection);
        $this->iterator->rewind();

    }

    /**
     * Countable interface method
     * @return int
     */
    public function count()
    {
        return $this->collection->count;
    }
}