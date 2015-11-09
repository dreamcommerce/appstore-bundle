<?php
namespace DreamCommerce\ShopAppstoreBundle\Form;


use Symfony\Component\Form\ChoiceList\LazyChoiceList;
use Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

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
     * @return ChoiceList The loaded choice list
     */
    public function loadChoiceList($value = null)
    {
        $values = [];
        $keys = [];

        foreach($this->resource as $r){
            $keys[] = call_user_func($this->keyResolver, $r);
            $values[] = call_user_func($this->valueResolver, $r);
        }

        return new ChoiceList($values, $keys);
    }

    /**
     * @inheritdoc
     */
    public function loadChoicesForValues(array $values, $value = null)
    {
        // TODO: Implement loadChoicesForValues() method.
    }

    /**
     * @inheritdoc
     */
    public function loadValuesForChoices(array $choices, $value = null)
    {
        // TODO: Implement loadValuesForChoices() method.
    }
}