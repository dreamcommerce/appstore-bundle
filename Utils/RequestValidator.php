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

    public function validate(){

        foreach(array('translation', 'place', 'shop', 'timestamp') as $param){
            if(!$this->request->query->has($param)){
                throw new InvalidRequestException(sprintf('Missing %s parameter', $param));
            }
        }

        $result = $this->validateHash();

        if(!$result){
            throw new InvalidRequestException('Invalid hash');
        }

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