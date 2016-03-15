<?php
namespace DreamCommerce\ShopAppstoreBundle\Form;


use Symfony\Component\Form\ChoiceList\ArrayChoiceList;
use Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;

/**
 * Class CollectionChoiceList
 *
 * choice from resource result
 *
 * @package DreamCommerce\ShopAppstoreBundle\Form
 */
class CollectionChoiceListLoader implements ChoiceLoaderInterface{

    /**
     * @var \ArrayObject|\Traversable
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
    /**
     * translated data
     * @var array
     */
    protected $data = [];

    /**
     * @param \ArrayObject|\Traversable $resource passed options resource
     * @param callable $keyResolver
     * @param callable $valueResolver
     */
    public function __construct($resource, callable $keyResolver, callable $valueResolver){

        $this->resource = $resource;
        $this->valueResolver = $valueResolver;
        $this->keyResolver = $keyResolver;

        $this->initializeData();
    }

    /**
     * transform resource to key=>value
     */
    public function initializeData()
    {

        $result = [];

        foreach($this->resource as $r){
            $value = call_user_func($this->valueResolver, $r);
            if(!$value){
                continue;
            }
            $key = call_user_func($this->keyResolver, $r);
            $result[$value] = $key;
        }

        $this->data = $result;
    }

    /**
     * creates options for form
     * @param null $value unused - needed to satisfy an interface
     * @return ArrayChoiceList
     */
    public function loadChoiceList($value = null)
    {
        return new ArrayChoiceList($this->data);
    }

    /**
     * satisfy interface
     * @param array $values values
     * @param null $value unused
     * @return array
     */
    public function loadChoicesForValues(array $values, $value = null)
    {
        return $values;
    }

    /**
     * satisfy interface
     * @param array $choices choices
     * @param null $value unused
     * @return array
     */
    public function loadValuesForChoices(array $choices, $value = null)
    {
        return $choices;
    }
}