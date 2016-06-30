<?php


namespace DreamCommerce\ShopAppstoreBundle\Utils\WebhookValidator;


class GlobalValidator extends ValidatorAbstract implements GlobalValidatorInterface
{

    public function setConfig($webhookConfiguration)
    {
        $this->events = $webhookConfiguration['events'];
        $this->secret = $webhookConfiguration['secret'];
    }


}