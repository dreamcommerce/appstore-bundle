<?php
namespace DreamCommerce\Component\ShopAppstore\Model;


use DreamCommerce\Component\Common\Model\ArrayableInterface;
use DreamCommerce\Component\Common\Model\ArrayableTrait;

final class ApplicationPayload implements ArrayableInterface
{
    use ArrayableTrait;

    const   ACTION_BILLING_INSTALL  = 'billing_install',
            ACTION_SUBSCRIPTION     = 'billing_subscription',
            ACTION_INSTALL          = 'install',
            ACTION_UPGRADE          = 'upgrade',
            ACTION_UNINSTALL        = 'uninstall'
    ;

    /**
     * @var string
     */
    private $action;

    /**
     * @var string
     */
    private $shop;

    /**
     * @var string
     */
    private $shopUrl;

    /**
     * @var string
     */
    private $applicationCode;

    /**
     * @var string
     */
    private $hash;

    /**
     * @var \DateTime
     */
    private $timestamp;

    /**
     * @var \DateTime
     */
    private $subscriptionEndTime;

    /**
     * @var int
     */
    private $applicationVersion;

    /**
     * @var string
     */
    private $authCode;

    /**
     * @var array
     */
    public static $servicedActions = [
        self::ACTION_BILLING_INSTALL,
        self::ACTION_INSTALL,
        self::ACTION_SUBSCRIPTION,
        self::ACTION_UPGRADE,
        self::ACTION_UNINSTALL
    ];


    public function __construct(array $applicationPayload)
    {
//        $this->action               = (string)$applicationPayload['action'];
//        $this->applicationCode      = (string)$applicationPayload['application_code'];
//        $this->applicationVersion   = (int)$applicationPayload['application_version'];
//        $this->authCode             = (string)$applicationPayload['auth_code'];
//        $this->shop                 = (string)$applicationPayload['shop'];
//        $this->shopUrl              = (string)$applicationPayload['shop_url'];
//        $this->timestamp            = \DateTime::createFromFormat('Y-m-d H:i:s', (string)$applicationPayload['timestamp']);
//        $this->hash                 = (string)$applicationPayload['hash'];

        $this->fromArray($applicationPayload, $this);
    }

    private function setTimestamp($timestamp)
    {
        $this->timestamp = $this->decodeDate($timestamp);
    }

    private function setSubscriptionEndTime($timestamp)
    {
        $this->subscriptionEndTime = $this->decodeDate($timestamp);
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getShop(): string
    {
        return $this->shop;
    }

    /**
     * @return string
     */
    public function getShopUrl(): string
    {
        return $this->shopUrl;
    }

    /**
     * @return string
     */
    public function getApplicationCode(): string
    {
        return $this->applicationCode;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }

    /**
     * @return mixed
     */
    public function getSubscriptionEndTime()
    {
        return $this->subscriptionEndTime;
    }

    /**
     * @return int
     */
    public function getApplicationVersion(): int
    {
        return $this->applicationVersion;
    }

    public function getAuthCode(): string
    {
        return $this->authCode;
    }

    private function decodeDate($time) : \DateTime
    {
        if (is_numeric($time)) {
            return \DateTime::createFromFormat('U', $time);
        } elseif (is_string($time)) {
            return new \DateTime($time);
        } elseif ($time instanceof \DateTime) {
            return $time;
        } else {
            throw new \InvalidArgumentException('Invalid date type set to ApplicationPayload');
        }
    }
}
