<?php


namespace DreamCommerce\ShopAppstoreBundle\DependencyInjection\Compiler;

use DreamCommerce\ShopAppstoreBundle\DependencyInjection\DreamCommerceShopAppstoreExtension;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DebuggerPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     * @throws Exception
     */
    public function process(ContainerBuilder $container)
    {

        $value = $container->getParameter(DreamCommerceShopAppstoreExtension::ALIAS.'.debug');

        $service = null;

        // if debug is null - use Symfony's debug settings and logger
        if(is_null($value)){
            $status = $container->getParameter('kernel.debug');
            $service = 'logger';
        // false means DISABLED
        }else if($value===false) {
            $status = false;
        // anything else - LoggerInterface compatible service logger
        }else{
            $status = true;
            $service = $value;
        }

        // only if service is specified
        if($status){

            $debugKey = DreamCommerceShopAppstoreExtension::ALIAS.'.logger';

            // check if exists
            if(!$container->has($service)){
                throw new Exception(sprintf('Debugger service %s does not exist', $service));
            }

            $def = $container->findDefinition($service);

            $class = $def->getClass();

            // check if service is LoggerInterface compatible
            if(!is_subclass_of($class, 'Psr\Log\LoggerInterface')){
                throw new Exception(sprintf('Debugger service %s does not implement Psr\Log\LoggerInterface', $service));
            }

            $container->setAlias($debugKey, $service);
        }

    }
}