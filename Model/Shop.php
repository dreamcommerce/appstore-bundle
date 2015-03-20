<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shop
 *
 * @ORM\Table(name="Shop", indexes={@ORM\Index(name="shop", columns={"shop"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @
 */
abstract class Shop implements ShopInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="shop", type="string", length=40, nullable=true)
     */
    protected $shop;

    /**
     * @var string
     *
     * @ORM\Column(name="shop_url", type="string", length=512, nullable=true)
     */
    protected $shopUrl;

    /**
     * @var \Billing
     * @ORM\OneToMany(mappedBy="Shop",targetEntity="Billing")
     */
    protected $billing;

    /**
     * @var \Shop
     */

    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Shop
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set shop
     *
     * @param string $shop
     * @return Shop
     */
    public function setShop($shop)
    {
        $this->shop = $shop;

        return $this;
    }

    /**
     * Get shop
     *
     * @return string 
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * Set shopUrl
     *
     * @param string $shopUrl
     * @return Shop
     */
    public function setShopUrl($shopUrl)
    {
        $this->shopUrl = $shopUrl;

        return $this;
    }

    /**
     * Get shopUrl
     *
     * @return string 
     */
    public function getShopUrl()
    {
        return $this->shopUrl;
    }
}
