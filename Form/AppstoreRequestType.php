<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-26
 * Time: 13:50
 */

namespace DreamCommerce\ShopAppstoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;

class AppstoreRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //todo: validation fields
        $builder
            ->add('application_code', 'text', array('label'=>'application_code'))
            ->add('shop', 'text', array('label'=>'shop'))
            ->add('shop_url', 'text', array('label'=>'shop_url'))
            ->add('timestamp', 'text', array('label'=>'timestamp'))
            ->add('hash', 'text', array('label'=>'hash'));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'allow_extra_fields'=>true,
        ));
    }

    public function getName()
    {
        return '';
    }
}