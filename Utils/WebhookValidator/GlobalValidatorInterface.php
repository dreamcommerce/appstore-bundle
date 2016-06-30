<?php


namespace DreamCommerce\ShopAppstoreBundle\Utils\WebhookValidator;


interface GlobalValidatorInterface extends ValidatorInterface
{
    public function setConfig($webhookConfiguration);
}