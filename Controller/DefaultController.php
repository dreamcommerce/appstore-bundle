<?php

namespace DreamCommerce\ShopAppstoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DreamCommerceShopAppstoreBundle:Default:index.html.twig', array('name' => $name));
    }
}
