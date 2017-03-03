<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\EventListener;


use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\Url;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;

/**
 * Class AppFormListener
 * listener appending needed request variables for forms
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\EventListener
 */
class AppFormListener {

    /**
     * @var Url
     */
    protected $url;
    /**
     * @var FormBuilderInterface
     */
    protected $builder;

    /**
     * @param Url $url
     * @param FormBuilderInterface $builder
     */
    public function __construct(Url $url, FormBuilderInterface $builder){
        $this->url = $url;
        $this->builder = $builder;
    }

    /**
     * appends params for form
     * @param FormEvent $event
     */
    public function appendValidationTokens(FormEvent $event){
        $action = $this->builder->getAction();
        $url = $this->url->appendApplicationParameters($action);
        $this->builder->setAction($url);
    }

}