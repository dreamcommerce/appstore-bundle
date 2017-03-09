<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 08.03.17
 * Time: 11:21
 */

namespace DreamCommerce\Bundle\ShopAppstoreBundle\Controller;


use DreamCommerce\Bundle\ShopAppstoreBundle\Controller\Types\RestApplicationControllerInterface;

abstract class RestApplicationController implements RestApplicationControllerInterface
{
    use ApplicationControllerTrait;

    //...
}