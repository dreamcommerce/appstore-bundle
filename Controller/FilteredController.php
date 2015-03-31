<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-28
 * Time: 15:10
 */

namespace DreamCommerce\ShopAppstoreBundle\Controller;


use DreamCommerce\Client;
use DreamCommerce\ShopAppstoreBundle\EventListener\AppFormListener;
use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;
use DreamCommerce\ShopAppstoreBundle\Utils\Url;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

abstract class FilteredController extends Controller implements FilteredControllerInterface{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var ShopInterface
     */
    protected $shop;

    public function injectClient(Client $client, ShopInterface $shop){
        $this->client = $client;
        $this->shop = $shop;
    }

    public function generateAppUrl($route, $parameters = array(), $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        /**
         * @var $rv Url
         */
        $rv = $this->get('dream_commerce_shop_appstore.url');
        return $rv->generateUrl($route, $parameters, $referenceType);
    }

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