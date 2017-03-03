<?php


namespace DreamCommerce\Bundle\ShopAppstoreBundle\Utils\Webhook\Validator;


interface GlobalValidatorInterface extends ValidatorInterface
{
    public function setConfig($webhookConfiguration);
}