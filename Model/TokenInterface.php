<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-19
 * Time: 14:30
 */
namespace DreamCommerce\ShopAppstoreBundle\Model;


/**
 * Accesstoken
 *
 * @ORM\Table(name="Token", indexes={@ORM\Index(name="shop_id", columns={"shop_id"})})
 * @ORM\Entity(repositoryClass="TokenRepository")
 * @ORM\HasLifecycleCallbacks
 */
interface TokenInterface
{
    /**
     * Set expiresAt
     *
     * @param \DateTime $expiresAt
     * @return Token
     */
    public function setExpiresAt($expiresAt);

    /**
     * Get expiresAt
     *
     * @return \DateTime
     */
    public function getExpiresAt();

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Token
     */
    public function setCreatedAt($createdAt);

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set accessToken
     *
     * @param string $accessToken
     * @return Token
     */
    public function setAccessToken($accessToken);

    /**
     * Get accessToken
     *
     * @return string
     */
    public function getAccessToken();

    /**
     * Set refreshToken
     *
     * @param string $refreshToken
     * @return Token
     */
    public function setRefreshToken($refreshToken);

    /**
     * Get refreshToken
     *
     * @return string
     */
    public function getRefreshToken();

    /**
     * Set shop
     *
     * @param Shop $shop
     * @return Token
     */
    public function setShop(Shop $shop = null);

    /**
     * Get shop
     *
     * @return \AppBundle\Entity\Shop
     */
    public function getShop();
}