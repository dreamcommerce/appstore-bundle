<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class Currency extends ResourceDependent implements CurrencyInterface
{
    /**
     * @var int
     */
    protected $currencyId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $rate;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var int
     */
    protected $order;

    /**
     * @var boolean
     */
    protected $default;

    /**
     * @var float
     */
    protected $rateSync;

    /**
     * @var string
     */
    protected $rateDate;

    /**
     * @var \ArrayAccess
     */
    protected $orders;

    /**
     * @var \ArrayAccess
     */
    protected $payments;

    /**
     * @var \ArrayAccess
     * @since 5.7.0
     */
    protected $products;

    public function __construct()
    {
        $this->orders = new \ArrayObject();
        $this->payments = new \ArrayObject();
        $this->products = new \ArrayObject();

        parent::__construct();
    }

    /**
     * @return int
     */
    public function getCurrencyId()
    {
        return $this->currencyId;
    }

    /**
     * @param int $currencyId
     */
    public function setCurrencyId($currencyId)
    {
        $this->currencyId = $currencyId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return boolean
     */
    public function isDefault()
    {
        return $this->default;
    }

    /**
     * @param boolean $default
     */
    public function setDefault($default)
    {
        $this->default = $default;
    }

    /**
     * @return float
     */
    public function getRateSync()
    {
        return $this->rateSync;
    }

    /**
     * @param float $rateSync
     */
    public function setRateSync($rateSync)
    {
        $this->rateSync = $rateSync;
    }

    /**
     * @return string
     */
    public function getRateDate()
    {
        return $this->rateDate;
    }

    /**
     * @param string $rateDate
     */
    public function setRateDate($rateDate)
    {
        $this->rateDate = $rateDate;
    }

    /**
     * @return \ArrayAccess
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param OrderInterface $order
     * @return $this
     */
    public function addOrder(OrderInterface $order)
    {
        $this->orders[] = $order;
        return $this;
    }

    /**
     * @param \ArrayAccess $orders
     * @return $this
     */
    public function setOrders($orders)
    {
        $this->orders = $orders;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * @param PaymentInterface $payment
     * @return $this
     */
    public function addPayment(PaymentInterface $payment)
    {
        $this->payments[] = $payment;
        return $this;
    }

    /**
     * @param \ArrayAccess $payments
     * @return $this
     */
    public function setPayments($payments)
    {
        $this->payments = $payments;
        return $payments;
    }

    /**
     * @return \ArrayAccess
     * @since 5.7.0
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param ProductInterface $product
     * @return $this
     * @since 5.7.0
     */
    public function addProduct(ProductInterface $product)
    {
        $this->products[] = $product;
        return $this;
    }

    /**
     * @param \ArrayAccess $products
     * @return $this
     * @since 5.7.0
     */
    public function setProducts($products)
    {
        $this->products = $products;
        return $this;
    }


    /**
     * @return string
     */
    public function getResourceClassName()
    {
        return '\\DreamCommerce\\Resource\\Currency';
    }

    /**
     * @return int
     */
    public function getResourceId()
    {
        return $this->currencyId;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id)
    {
        $this->currencyId = $id;
        return $this;
    }
}