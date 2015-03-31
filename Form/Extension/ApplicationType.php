<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-31
 * Time: 12:48
 */

namespace DreamCommerce\ShopAppstoreBundle\Form\Extension;


use DreamCommerce\ShopAppstoreBundle\EventListener\AppFormListener;
use DreamCommerce\ShopAppstoreBundle\Utils\Url;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

abstract class ApplicationType extends AbstractType{

    protected $url;

    public function __construct(Url $url){
        $this->url = $url;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        if($this->url){
            $listener = new AppFormListener($this->url, $builder);
            $builder->addEventListener(FormEvents::PRE_SUBMIT, array($listener, 'appendValidationTokens'));
        }
    }
}