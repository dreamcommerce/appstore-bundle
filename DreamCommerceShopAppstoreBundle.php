<?php

namespace DreamCommerce\ShopAppstoreBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DreamCommerceShopAppstoreBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        //parent::build($container);

        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'DreamCommerce\ShopAppstoreBundle\Model',
            realpath(__DIR__ . '/Resources/config/doctrine') => 'DreamCommerce\ShopAppstoreBundle\Entity',
        );

        $container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver($mappings));
    }


}
