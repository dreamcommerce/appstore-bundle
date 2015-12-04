<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface ProductStockInterface extends ResourceDependentInterface
{
    /**
     * @return ProductInterface
     */
    public function getProduct();

    /**
     * @param ProductInterface $product
     * @return $this
     */
    public function setProduct(ProductInterface $product);

    /**
     * @return AvailabilityInterface
     */
    public function getAvailability();

    /**
     * @param AvailabilityInterface $availability
     * @return $this
     */
    public function setAvailability(AvailabilityInterface $availability);

    /**
     * @return DeliveryInterface
     */
    public function getDelivery();

    /**
     * @param DeliveryInterface $delivery
     * @return $this
     */
    public function setDelivery(DeliveryInterface $delivery);
    /**
     * @return ProductImageInterface
     */
    public function getImage();

    /**
     * @param ProductImageInterface $image
     * @return $this
     */
    public function setImage(ProductImageInterface $image);
}