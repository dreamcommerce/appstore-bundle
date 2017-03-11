<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator;


use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator\Types\AppstoreRequestValidatorInterface;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationPayload;

class AppstoreRequestValidator extends RequestValidatorAbstract implements AppstoreRequestValidatorInterface
{
    protected function init() {
        $this->setApplication($this->getApplicationNameFromRequest());
    }


    public function validate(): ApplicationPayload
    {
        try {

            $handler = $this->getHandler();
            $payload = $this->getRequest()->request->all();
            $handler->verifyPayload($payload);

        } catch(HandlerException $ex) {
            throw new InvalidRequestException('', 0, $ex);
        }

        return new ApplicationPayload($payload);
    }
}