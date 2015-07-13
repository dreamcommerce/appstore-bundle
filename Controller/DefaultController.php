<?php

namespace DreamCommerce\ShopAppstoreBundle\Controller;

class DefaultController extends ApplicationController
{
    public function indexAction($name)
    {
        return $this->render('DreamCommerceShopAppstoreBundle:Default:index.html.twig', array('name' => $name));
    }
}
