<?php


namespace DreamCommerce\Bundle\ShopAppstoreBundle\Utils\Webhook\Validator;


use DreamCommerce\Bundle\ShopAppstoreBundle\Handler\Application;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;

interface AppValidatorInterface extends ValidatorInterface
{
    public function setShop(ShopInterface $shop);
    public function setConfig(Application $app, $webhookName);
}