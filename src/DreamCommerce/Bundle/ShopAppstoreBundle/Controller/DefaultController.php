<?php

namespace DreamCommerce\Bundle\ShopAppstoreBundle\Controller;

/**
 * Class DefaultController
 * an example shop-aware controller
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Controller
 */
class DefaultController extends ApplicationController
{
    public function indexAction($name)
    {
        return $this->render('DreamCommerceShopAppstoreBundle:Default:index.html.twig', array('url' => $this->shop->getShopUrl()));
    }
}
