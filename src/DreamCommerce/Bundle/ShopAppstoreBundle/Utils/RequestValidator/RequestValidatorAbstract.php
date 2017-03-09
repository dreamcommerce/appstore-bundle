<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 09.03.17
 * Time: 20:45
 */

namespace DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator;



use Symfony\Component\HttpFoundation\Request;

abstract class RequestValidatorAbstract
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @param Request $req
     */
    public function __construct(Request $req)
    {
        $this->request = $req;
    }

    /**
     * Return request object
     *
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }


}