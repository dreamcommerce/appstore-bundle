<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 18.02.17
 * Time: 18:33
 */

namespace DreamCommerce\Bundle\ShopAppstoreBundle\Tests\Utils\CollectionWrapper;


class SomeObject
{
    private $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    public function getField()
    {
        return $this->field;
    }
}