<?php


namespace DreamCommerce\Bundle\ShopAppstoreBundle\Utils\Webhook\Validator;


class GlobalValidator extends ValidatorAbstract implements GlobalValidatorInterface
{

    public function setConfig($webhookConfiguration)
    {
        $this->events = $webhookConfiguration['events'];
        $this->secret = $webhookConfiguration['secret'];
    }


}