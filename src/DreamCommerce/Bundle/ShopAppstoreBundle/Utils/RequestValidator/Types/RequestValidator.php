<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 09.03.17
 * Time: 20:49
 */

namespace DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator;


use Symfony\Component\BrowserKit\Request;

interface RequestValidator
{
    /**
     * Return application name, using request to resolve
     *
     * @param array $applications
     * @return string
     */
    public function getApplicationName(array $applications): string;

    /**
     * RequestValidator constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request);

    /**
     * Get Request object set in constructor
     *
     * @return Request
     */
    public function getRequest(): Request;

    /**
     * TODO: Check type for $application
     *
     * @param $application
     * @return mixed
     */
    public function setApplication($application);
}