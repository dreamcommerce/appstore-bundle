<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-25
 * Time: 13:45
 */

namespace DreamCommerce\ShopAppstoreBundle\Utils;


use Symfony\Component\HttpFoundation\Request;

class RequestValidator {

    protected $request;
    protected $application;

    public function __construct(Request $req, $application){
        $this->request = $req;
        $this->application = $application;
    }

    protected function getCheckedFields(){
        return array('translation', 'place', 'shop', 'timestamp');
    }

    public function validate(){

        foreach($this->getCheckedFields() as $param){
            if(!$this->request->query->has($param)){
                throw new InvalidRequestException(sprintf('Missing %s parameter', $param));
            }
        }

        $result = $this->validateHash();

        if(!$result){
            throw new InvalidRequestException('Invalid hash');
        }

    }

    public function getValidationParams(){
        $result = array();
        foreach($this->getCheckedFields() as $f){
            $result[$f] = $this->request->query->get($f);
        }
        return $result;
    }

    protected function validateHash(){

        $paramsBag = $this->request->query;

        $params = array(
            'place' => $paramsBag->get('place'),
            'shop' => $paramsBag->get('shop'),
            'timestamp' => $paramsBag->get('timestamp'),
        );

        ksort($params);
        $parameters = array();
        foreach ($params as $k => $v) {
            $parameters[] = $k . "=" . $v;
        }
        $p = join("&", $parameters);


        $hash = hash_hmac('sha512', $p, $this->application['appstore_secret']);

        return $hash != $paramsBag->get('hash');
    }

}