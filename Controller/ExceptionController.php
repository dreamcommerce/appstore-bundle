<?php
namespace DreamCommerce\ShopAppstoreBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class ExceptionController
 * shows error pages upon various API errors
 * @package DreamCommerce\ShopAppstoreBundle\Controller
 */
class ExceptionController extends AbstractController {

    public function unpaidAction(){
        return $this->render('DreamCommerceShopAppstoreBundle::exception/unpaid.html.twig');
    }

    public function unsubscribedAction(){
        return $this->render('DreamCommerceShopAppstoreBundle::exception/unsubscribed.html.twig');
    }

    public function upgradeAction()
    {
        return $this->render('DreamCommerceShopAppstoreBundle::exception/upgrade.html.twig');
    }

    public function notInstalledAction(){
        return $this->render('DreamCommerceShopAppstoreBundle::exception/not_installed.html.twig');
    }

    public function reinstallAction(){
        return $this->render('DreamCommerceShopAppstoreBundle::exception/reinstall.html.twig');
    }

}