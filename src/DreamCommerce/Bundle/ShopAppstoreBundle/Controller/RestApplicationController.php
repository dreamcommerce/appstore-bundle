<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 08.03.17
 * Time: 11:21
 */

namespace DreamCommerce\Bundle\ShopAppstoreBundle\Controller;


use DreamCommerce\Bundle\ShopAppstoreBundle\Controller\Types\RestApplicationControllerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class RestApplicationController extends Controller implements RestApplicationControllerInterface
{
    use ApplicationControllerTrait;
}