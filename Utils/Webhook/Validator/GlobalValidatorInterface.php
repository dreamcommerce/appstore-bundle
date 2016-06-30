<?php


namespace DreamCommerce\ShopAppstoreBundle\Utils\Webhook\Validator;


interface GlobalValidatorInterface extends ValidatorInterface
{
    public function setConfig($webhookConfiguration);
}