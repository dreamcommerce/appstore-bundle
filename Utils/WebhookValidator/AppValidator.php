<?php


namespace DreamCommerce\ShopAppstoreBundle\Utils\WebhookValidator;


use DreamCommerce\ShopAppstoreBundle\Handler\Application;
use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;

class AppValidator extends ValidatorAbstract implements AppValidatorInterface
{

    /**
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @var string
     */
    protected $oldSecret = null;
    /**
     * @var Application
     */
    protected $app;

    /**
     * @param ShopInterface $shop
     */
    protected function createSecret(ShopInterface $shop){
        
        if(empty($this->oldSecret)){
            $this->oldSecret = $this->secret;
        }        
        
        $this->secret = hash_hmac('sha512', $shop->getName() . ":" . $this->oldSecret, $this->app->getAppstoreSecret());
    }

    /**
     * @param ShopInterface $shop
     */
    public function setShop(ShopInterface $shop)
    {
        $this->createSecret($shop);

        $this->shop = $shop;
    }

    /**
     * @param Application $app
     * @param string $webhookName
     */
    public function setConfig(Application $app, $webhookName)
    {
        $config = $app->getWebhook($webhookName);

        $this->app = $app;
        $this->secret = $config['secret'];
        $this->events = $config['events'];
    }
}