<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator;


use Symfony\Component\HttpFoundation\Request;

interface RequestValidator
{
    public function __construct(Request $request);

    public function getRequest(): Request;

    public function getApplicationName(array $applications);
}