<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Controller;


use DreamCommerce\Bundle\ShopAppstoreBundle\Controller\Types\StandardApplicationControllerInterface;
use DreamCommerce\Bundle\ShopAppstoreBundle\EventListener\AppFormListener;
use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\Url;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ApplicationController
 *
 * provides shop-protected, generic controller class
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Controller
 */
abstract class ApplicationController extends Controller implements StandardApplicationControllerInterface
{
    use ApplicationControllerTrait;

    /**
     * generates URL injecting iframe params to the query
     * @param string $route #Route
     * @param array $parameters
     * @param bool $referenceType
     * @return string
     */
    public function generateAppUrl($route, $parameters = array(), $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        /**
         * @var $rv Url
         */
        $rv = $this->get('dream_commerce_shop_appstore.url');
        return $rv->generateUrl($route, $parameters, $referenceType);
    }

    /**
     * creates form builder with iframe params
     * @see generateAppUrl
     * @param null $data
     * @param array $options
     * @return \Symfony\Component\Form\FormBuilder
     */
    public function createFormBuilder($data = null, array $options = array())
    {
        $builder = parent::createFormBuilder($data, $options);

        /**
         * @var $urlBuilder Url
         */
        $urlBuilder = $this->get('dream_commerce_shop_appstore.url');
        $listener = new AppFormListener($urlBuilder, $builder);
        $builder->addEventListener(FormEvents::PRE_SUBMIT, array($listener, 'appendValidationTokens'));

        return $builder;
    }


}