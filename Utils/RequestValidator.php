<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-25
 * Time: 13:45
 */

namespace DreamCommerce\ShopAppstoreBundle\Utils;


use DreamCommerce\Exception\HandlerException;
use DreamCommerce\Handler;
use Symfony\Component\HttpFoundation\Request;

class RequestValidator{

    protected $request;
    protected $application;

    public function __construct(Request $req){
        $this->request = $req;
    }

    public function getApplicationName($applications){

        $code = $this->request->query->get('application');

        if(!$code){
            $code = $this->request->request->get('application_code');
        }

        if(!$code){
            throw new InvalidRequestException('Cannot find application_code field');
        }

        foreach($applications as $key=>$data) {
            $found = null;

            if ($code == $data['app_id']) {
                return $key;
            }
        }

        throw new InvalidRequestException(sprintf('Application ID#%s not configured', $code));
    }

    public function setApplication($application){
        $this->application = $application;
    }

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

    public function validateAppstoreRequest(){

        try {

            $handler = $this->getHandler();

            $payload = $this->request->request->all();

            $handler->verifyPayload($payload);

        }catch(HandlerException $ex){
            throw new InvalidRequestException('',0,$ex);
        }

        return $payload;

    }

    protected function getHandler()
    {
        return new Handler(
            $this->request->request->get('shop_url', 'https://example.org'),
            $this->application['app_id'],
            $this->application['app_secret'],
            $this->application['appstore_secret']
        );
    }

    /**
     * @return array
     */
    public function getAppValidationParams()
    {
        $payload = array();
        foreach (array('place', 'shop', 'timestamp', 'hash') as $f) {
            $payload[$f] = $this->request->query->get($f);
        }
        return $payload;
    }

}