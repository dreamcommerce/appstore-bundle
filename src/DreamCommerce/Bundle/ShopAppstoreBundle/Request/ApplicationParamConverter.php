<?php


namespace DreamCommerce\Bundle\ShopAppstoreBundle\Request;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class ApplicationParamConverter implements ParamConverterInterface
{

    /**
     * Stores the object in the request.
     *
     * @param Request $request The request
     * @param ParamConverter $configuration Contains the name, class and options of the object
     *
     * @return bool True if the object has been successfully set, else false
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        if($configuration->getClass()=='DreamCommerce\ShopAppstoreLib\ClientInterface'){
            $this->mapAttribute('_dream_commerce_shop_appstore_client', $configuration, $request);
        }else if($configuration->getClass()=='DreamCommerce\Component\ShopAppstore\Model\ShopInterface'){
            $this->mapAttribute('_dream_commerce_shop_appstore_shop', $configuration, $request);
        }else{
            return false;
        }

        return true;
    }

    /**
     * map specified attribute to configured variable
     * @param $attribute
     * @param ParamConverter $configuration
     * @param Request $request
     */
    protected function mapAttribute($attribute, ParamConverter $configuration, Request $request)
    {
        if($request->attributes->has($attribute)){
            $name = $configuration->getName();
            $request->attributes->set(
                $name, $request->attributes->get($attribute)
            );
        }
    }

    /**
     * Checks if the object is supported.
     *
     * @param ParamConverter $configuration Should be an instance of ParamConverter
     *
     * @return bool True if the object is supported, else false
     */
    public function supports(ParamConverter $configuration)
    {
        $class = $configuration->getClass();

        return $class=='DreamCommerce\ShopAppstoreLib\ClientInterface'
            || $class=='DreamCommerce\Component\ShopAppstore\Model\ShopInterface';

    }
}