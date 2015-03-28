<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-25
 * Time: 13:32
 */

namespace DreamCommerce\ShopAppstoreBundle\Event;


use Symfony\Component\EventDispatcher\Event;

class ActionEvent extends Event{

    protected $metadata;

    public function __construct($metadata){
        $this->metadata = $metadata;
    }

    public function getMetadata(){
        return $this->metadata;
    }

}