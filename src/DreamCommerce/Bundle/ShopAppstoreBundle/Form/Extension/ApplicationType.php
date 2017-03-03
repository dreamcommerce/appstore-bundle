<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Form\Extension;


use DreamCommerce\Bundle\ShopAppstoreBundle\EventListener\AppFormListener;
use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\Url;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;

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