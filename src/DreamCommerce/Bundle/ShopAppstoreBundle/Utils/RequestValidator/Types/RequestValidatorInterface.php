<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator\Types;

use DreamCommerce\Component\ShopAppstore\Model\ApplicationPayload;
use Symfony\Component\HttpFoundation\Request;

interface RequestValidatorInterface
{
    /**
     * RequestValidator constructor.
     *
     * @param Request $request
     * @param array $apps Array of application using by application
     */
    public function __construct(Request $request, array $apps);

    /**
     * Get Request object set in constructor
     *
     * @return Request
     */
    public function getRequest(): Request;

    //TODO: Zwracac obiekt zamiast tablicy
    public function getApplication(): array;


    public function validate(): ApplicationPayload;
}