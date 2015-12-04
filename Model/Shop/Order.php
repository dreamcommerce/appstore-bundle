<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class Order extends ResourceDependent implements OrderInterface
{
    /**
     * @var int
     */
    protected $orderId;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var \DateTime
     */
    protected $statusDate;

    /**
     * @var \DateTime
     */
    protected $confirmDate;

    /**
     * @var \DateTime
     */
    protected $deliveryDate;

    /**
     * @var float
     */
    protected $sum;

    /**
     * @var boolean
     */
    protected $userOrder;

    /**
     * @var float
     */
    protected $shippingCost;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $deliveryCode;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var boolean
     */
    protected $confirm;

    /**
     * @var string
     */
    protected $notes;

    /**
     * @var string
     */
    protected $notesPriv;

    /**
     * @var string
     */
    protected $notesPub;

    /**
     * @var float
     */
    protected $currencyRate;

    /**
     * @var float
     */
    protected $paid;

    /**
     * @var string
     */
    protected $ipAddress;

    /**
     * @var float
     */
    protected $discountClient;

    /**
     * @var float
     */
    protected $discountGroup;

    /**
     * @var float
     */
    protected $discountLevels;

    /**
     * @var float
     */
    protected $discountCode;

    /**
     * @var float
     */
    protected $shippingVatValue;

    /**
     * @var string
     */
    protected $shippingVatName;

    /**
     * @var int
     */
    protected $origin;

    /**
     * @var CurrencyInterface
     */
    protected $currency;

    /**
     * @var ShippingInterface
     */
    protected $shipping;

    /**
     * @var PaymentInterface
     */
    protected $payment;

    /**
     * @var StatusInterface
     */
    protected $status;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var AuctionOrderInterface
     */
    protected $auctionOrder;

    /**
     * @var OrderAddressInterface
     */
    protected $billingAddress;

    /**
     * @var OrderAddressInterface
     */
    protected $deliveryAddress;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var \ArrayAccess
     */
    protected $products;

    /**
     * @var \ArrayAccess
     */
    protected $additionalFields;

    public function __construct()
    {
        $this->products = new \ArrayObject();
        $this->additionalFields = new \ArrayObject();

        parent::__construct();
    }

    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     * @return $this
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime|string $date
     * @return $this
     */
    public function setDate($date)
    {
        if(is_string($date)) {
            $date = new \DateTime($date);
        }

        $this->date = $date;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStatusDate()
    {
        return $this->statusDate;
    }

    /**
     * @param \DateTime|string $statusDate
     * @return $this
     */
    public function setStatusDate($statusDate)
    {
        if(is_string($statusDate)) {
            $statusDate = new \DateTime($statusDate);
        }

        $this->statusDate = $statusDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getConfirmDate()
    {
        return $this->confirmDate;
    }

    /**
     * @param \DateTime|string $confirmDate
     * @return $this
     */
    public function setConfirmDate($confirmDate)
    {
        if(is_string($confirmDate)) {
            $confirmDate = new \DateTime($confirmDate);
        }

        $this->confirmDate = $confirmDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * @param \DateTime|string $deliveryDate
     * @return $this
     */
    public function setDeliveryDate($deliveryDate)
    {
        if(is_string($deliveryDate)) {
            $deliveryDate = new \DateTime($deliveryDate);
        }

        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    /**
     * @return float
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * @param float $sum
     * @return $this
     */
    public function setSum($sum)
    {
        $this->sum = $sum;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isUserOrder()
    {
        return $this->userOrder;
    }

    /**
     * @param boolean $userOrder
     * @return $this
     */
    public function setUserOrder($userOrder)
    {
        $this->userOrder = $userOrder;
        return $this;
    }

    /**
     * @return float
     */
    public function getShippingCost()
    {
        return $this->shippingCost;
    }

    /**
     * @param float $shippingCost
     * @return $this
     */
    public function setShippingCost($shippingCost)
    {
        $this->shippingCost = $shippingCost;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryCode()
    {
        return $this->deliveryCode;
    }

    /**
     * @param string $deliveryCode
     * @return $this
     */
    public function setDeliveryCode($deliveryCode)
    {
        $this->deliveryCode = $deliveryCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isConfirm()
    {
        return $this->confirm;
    }

    /**
     * @param boolean $confirm
     * @return $this
     */
    public function setConfirm($confirm)
    {
        $this->confirm = $confirm;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     * @return $this
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotesPriv()
    {
        return $this->notesPriv;
    }

    /**
     * @param string $notesPriv
     * @return $this
     */
    public function setNotesPriv($notesPriv)
    {
        $this->notesPriv = $notesPriv;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotesPub()
    {
        return $this->notesPub;
    }

    /**
     * @param string $notesPub
     * @return $this
     */
    public function setNotesPub($notesPub)
    {
        $this->notesPub = $notesPub;
        return $this;
    }

    /**
     * @return float
     */
    public function getCurrencyRate()
    {
        return $this->currencyRate;
    }

    /**
     * @param float $currencyRate
     * @return $this
     */
    public function setCurrencyRate($currencyRate)
    {
        $this->currencyRate = $currencyRate;
        return $this;
    }

    /**
     * @return float
     */
    public function getPaid()
    {
        return $this->paid;
    }

    /**
     * @param float $paid
     * @return $this
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;
        return $this;
    }

    /**
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param string $ipAddress
     * @return $this
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountClient()
    {
        return $this->discountClient;
    }

    /**
     * @param float $discountClient
     * @return $this
     */
    public function setDiscountClient($discountClient)
    {
        $this->discountClient = $discountClient;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountGroup()
    {
        return $this->discountGroup;
    }

    /**
     * @param float $discountGroup
     * @return $this
     */
    public function setDiscountGroup($discountGroup)
    {
        $this->discountGroup = $discountGroup;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountLevels()
    {
        return $this->discountLevels;
    }

    /**
     * @param float $discountLevels
     * @return $this
     */
    public function setDiscountLevels($discountLevels)
    {
        $this->discountLevels = $discountLevels;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountCode()
    {
        return $this->discountCode;
    }

    /**
     * @param float $discountCode
     * @return $this
     */
    public function setDiscountCode($discountCode)
    {
        $this->discountCode = $discountCode;
        return $this;
    }

    /**
     * @return float
     */
    public function getShippingVatValue()
    {
        return $this->shippingVatValue;
    }

    /**
     * @param float $shippingVatValue
     * @return $this
     */
    public function setShippingVatValue($shippingVatValue)
    {
        $this->shippingVatValue = $shippingVatValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingVatName()
    {
        return $this->shippingVatName;
    }

    /**
     * @param string $shippingVatName
     * @return $this
     */
    public function setShippingVatName($shippingVatName)
    {
        $this->shippingVatName = $shippingVatName;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param int $origin
     * @return $this
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
        return $this;
    }

    /**
     * @return CurrencyInterface
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param CurrencyInterface $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return ShippingInterface
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param ShippingInterface $shipping
     * @return $this
     */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;
        return $this;
    }

    /**
     * @return PaymentInterface
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param PaymentInterface $payment
     * @return $this
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
        return $this;
    }

    /**
     * @return StatusInterface
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param StatusInterface $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param UserInterface $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return AuctionInterface
     */
    public function getAuctionOrder()
    {
        return $this->auctionOrder;
    }

    /**
     * @param AuctionInterface $auctionOrder
     * @return $this
     */
    public function setAuctionOrder($auctionOrder)
    {
        $this->auctionOrder = $auctionOrder;
        return $this;
    }

    /**
     * @return OrderAddressInterface
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @param OrderAddressInterface $billingAddress
     * @return $this
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    /**
     * @return OrderAddressInterface
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @param OrderAddressInterface $deliveryAddress
     * @return $this
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
        return $this;
    }

    /**
     * @return LanguageInterface
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param LanguageInterface $language
     * @return $this
     */
    public function setLanguage(LanguageInterface $language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param OrderProductInterface $product
     * @return $this
     */
    public function addProduct(OrderProductInterface $product)
    {
        $this->products[] = $product;
        return $this;
    }

    /**
     * @param \ArrayAccess $products
     * @return $this
     */
    public function setProducts($products)
    {
        $this->products = $products;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getAdditionalFields()
    {
        return $this->additionalFields;
    }

    /**
     * @param OrderAdditionalFieldInterface $additionalField
     * @return $this
     */
    public function addAdditionalField(OrderAdditionalFieldInterface $additionalField)
    {
        $this->additionalFields[] = $additionalField;
        return $this;
    }

    /**
     * @param \ArrayAccess $additionalFields
     * @return $this
     */
    public function setAdditionalFields($additionalFields)
    {
        $this->additionalFields = $additionalFields;
        return $this;
    }

    /**
     * @return string
     */
    public function getResourceClassName()
    {
        return '\\DreamCommerce\\Resource\\Order';
    }

    /**
     * @return int
     */
    public function getResourceId()
    {
        return $this->orderId;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id)
    {
        $this->orderId = $id;
        return $this;
    }
}