<?php
namespace DreamCommerce\ShopAppstoreBundle\Form;


use Symfony\Component\Form\ChoiceList\ArrayChoiceList;
use Symfony\Component\Form\ChoiceList\LazyChoiceList;
use Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;

/**
 * Class CollectionChoiceList
 *
 * choice from resource result
 *
 * @package DreamCommerce\ShopAppstoreBundle\Form
 */
class CollectionChoiceList extends LazyChoiceList implements ChoiceLoaderInterface{

    /**
     * @var Resource
     */
    protected $resource;
    /**
     * @var callable
     */
    protected $valueResolver;
    /**
     * @var callable
     */
    protected $keyResolver;

    public function __construct(\Traversable $resource, callable $keyResolver, callable $valueResolver){

        parent::__construct($this);

        $this->resource = $resource;
        $this->valueResolver = $valueResolver;
        $this->keyResolver = $keyResolver;
    }


    /**
     * Loads the choice list.
     *
     * Should be implemented by child classes.
     *
     * @param null $value
     * @return ArrayChoiceList The loaded choice list
     */
    public function loadChoiceList($value = null)
    {
        $result = [];

        foreach($this->resource as $r){
            $result[call_user_func($this->keyResolver, $r)] = call_user_func($this->valueResolver, $r);
        }

        return new ArrayChoiceList($result);
    }

    /**
     * @inheritdoc
     */
    public function loadChoicesForValues(array $values, $value = null)
    {
        // not needed so far
    }

    /**
     * @inheritdoc
     */
    public function loadValuesForChoices(array $choices, $value = null)
    {
        // not needed so far
    }
}