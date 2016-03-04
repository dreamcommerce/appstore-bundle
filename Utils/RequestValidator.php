<?php
namespace DreamCommerce\ShopAppstoreBundle\Utils;


use DreamCommerce\ShopAppstoreLib\Exception\HandlerException;
use DreamCommerce\ShopAppstoreLib\Handler;
use DreamCommerce\ShopAppstoreBundle\Utils\RequestValidator\InvalidRequestException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestValidator
 *
 * validates request against shop/appstore parameters
 *
 * @package DreamCommerce\ShopAppstoreBundle\Utils
 */
class RequestValidator{

    /**
     * Symfony request object
     * @var Request
     */
    protected $request;
    /**
     * application configuration data
     * @var array
     */
    protected $application;

    /**
     * @param Request $req
     */
    public function __construct(Request $req){
        $this->request = $req;
    }

    /**
     * return request object
     * @return Request
     */
    protected function getRequest(){
        return $this->request;
    }

    /**
     * tests request against applications information
     * @param array $applications configuration data
     * @return string
     * @throws InvalidRequestException
     */
    public function getApplicationName($applications){

        // get request application code
        $code = $this->getRequest()->query->get('application');

        // if it's not GET - check code from POST
        if(!$code){
            $code = $this->getRequest()->request->get('application_code');
        }

        // no code - no work
        if(!$code){
            throw new InvalidRequestException('Cannot find application_code field');
        }

        // iterate over applications list
        foreach($applications as $key=>$data) {
            $found = null;

            if ($code == $data['app_id']) {
                return $key;
            }
        }

        // application has not been found
        throw new InvalidRequestException(sprintf('Application ID#%s not configured', $code));
    }

    /**
     * set current application
     * @param array $application
     */
    public function setApplication($application){
        $this->application = $application;
    }

    /**
     * validate application iframe request parameters
     * @return array parameters needed to pass through to next request
     * @throws InvalidRequestException
     */
    public function validateAppRequest(){

        try{
            $handler = $this->getHandler();

            $payload = $this->getAppValidationParams();

            $handler->verifyPayload($payload);
        } catch(HandlerException $ex){
            throw new InvalidRequestException('',0,$ex);
        }


        return $payload;

    }

    /**
     * validate appstore responder request
     * @return array
     * @throws InvalidRequestException
     */
    public function validateAppstoreRequest(){

        try {

            $handler = $this->getHandler();

            $payload = $this->getRequest()->request->all();

            $handler->verifyPayload($payload);

        }catch(HandlerException $ex){
            throw new InvalidRequestException('',0,$ex);
        }

        return $payload;

    }

    /**
     * get library handler instance
     * @return Handler
     */
    protected function getHandler()
    {
        return new Handler(
            $this->getRequest()->request->get('shop_url', 'https://example.org'),
            $this->application['app_id'],
            $this->application['app_secret'],
            $this->application['appstore_secret']
        );
    }

    /**
     * get request needed variables - useful in URL generating
     * @return array
     */
    public function getAppValidationParams()
    {
        $payload = array();
        foreach (array('place', 'shop', 'timestamp', 'hash') as $f) {
            $payload[$f] = $this->getRequest()->query->get($f);
        }
        return $payload;
    }

}