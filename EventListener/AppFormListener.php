<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-31
 * Time: 12:18
 */

namespace DreamCommerce\ShopAppstoreBundle\EventListener;


use DreamCommerce\ShopAppstoreBundle\Utils\Url;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;

class AppFormListener {

    protected $url;
    protected $builder;

    public function __construct(Url $url, FormBuilderInterface $builder){
        $this->url = $url;
        $this->builder = $builder;
    }

    public function appendValidationTokens(FormEvent $event){
        $action = $this->builder->getAction();
        $url = $this->url->adjustUrl($action);
        $this->builder->setAction($url);
    }

}