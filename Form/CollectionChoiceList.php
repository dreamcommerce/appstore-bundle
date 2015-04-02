<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-04-01
 * Time: 17:36
 */

namespace DreamCommerce\ShopAppstoreBundle\Form;


use DreamCommerce\ShopAppstoreBundle\Utils\CollectionWrapper;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceListInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\LazyChoiceList;
use Symfony\Component\Form\Extension\Core\ChoiceList\ObjectChoiceList;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;

class CollectionChoiceList extends LazyChoiceList{

    /**
     * @var Resource
     */
    protected $resource;
    /**
     * @var callable
     */
    protected $valueResolver;

    public function __construct(\ArrayObject $resource, callable $valueResolver){

        $this->resource = $resource;
        $this->valueResolver = $valueResolver;
    }


    /**
     * Loads the choice list.
     *
     * Should be implemented by child classes.
     *
     * @return ChoiceListInterface The loaded choice list
     */
    public function loadChoiceList()
    {
        $v = array();
        foreach($this->resource as $r){
            $v[$r->product_id] = call_user_func($this->valueResolver, $r);
        }

        return new SimpleChoiceList($v);
    }
}