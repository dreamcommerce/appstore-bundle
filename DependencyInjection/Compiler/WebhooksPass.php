<?php


namespace DreamCommerce\ShopAppstoreBundle\DependencyInjection\Compiler;


use DreamCommerce\ShopAppstoreBundle\DependencyInjection\DreamCommerceShopAppstoreExtension;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class WebhooksPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $globalWebhooks = $container->getParameter(DreamCommerceShopAppstoreExtension::ALIAS.'.webhooks');
        foreach($globalWebhooks as $k=>$v){
            try {
                $this->webhooksValidator($container, $v['validator']);
            }catch(\Exception $ex){
                throw new \InvalidArgumentException(sprintf('Global webhook (%s): %s', $k, $ex->getMessage()));
            }
        }

        $apps = $container->getParameter(DreamCommerceShopAppstoreExtension::ALIAS.'.apps');
        foreach($apps as $appId=>$app){
            foreach ($app['webhooks'] as $k => $v) {
                try {
                    $this->webhooksValidator($container, $v['validator'], true);
                } catch (\Exception $ex) {
                    throw new \InvalidArgumentException(sprintf('Application (%s) webhook (%s): %s', $appId, $k, $ex->getMessage()));
                }
            }
        }
    }

    protected function webhooksValidator(ContainerBuilder $container, $serviceId, $appContext = false){

        // non-existing definition -> ServiceNotFoundException
        $def = $container->findDefinition($serviceId);
        $class = $def->getClass();

        $interfaces = class_implements($class);
        $neededInterface = sprintf('DreamCommerce\ShopAppstoreBundle\Utils\Webhook\Validator\%sValidatorInterface', $appContext ? 'App' : 'Global');

        if(!in_array($neededInterface, $interfaces)){
            throw new \Exception(sprintf('Service "%s" doesn\'t implement %s', $serviceId, $neededInterface));
        }
        

    }
}