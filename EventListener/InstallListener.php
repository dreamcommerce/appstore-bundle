<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-25
 * Time: 13:18
 */

namespace DreamCommerce\ShopAppstoreBundle\EventListener;


use DreamCommerce\ShopAppstoreBundle\Model\ShopManagerInterface;

class InstallListener implements ActionListenerInterface{

    public function __construct(ShopManagerInterface $manager){
        //
    }

    public function onShopInstall(ActionEvent $event){
        $data = $event->getMetadata();
    }

}