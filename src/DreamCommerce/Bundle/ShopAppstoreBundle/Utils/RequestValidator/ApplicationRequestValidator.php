<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator;

use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator\Types\ApplicationRequestValidatorInterface;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationPayload;

class ApplicationRequestValidator extends RequestValidatorAbstract implements ApplicationRequestValidatorInterface
{
    protected function init() {
        $this->setApplication($this->getApplicationNameFromRequest());
    }

    public function validate(): ApplicationPayload
    {
        try {
            $handler = $this->getHandler();
            $payload = $this->getAppValidationParams();
            $handler->verifyPayload($payload);

        } catch(HandlerException $ex){
            throw new InvalidRequestException('', 0, $ex);
        }

        return new ApplicationPayload($payload);
    }

    public function getAppValidationParams()
    {
        $payload = array();
        foreach (array('place', 'shop', 'timestamp', 'hash') as $f) {
            $payload[$f] = $this->getRequest()->query->get($f);
        }

        return $payload;
    }
}