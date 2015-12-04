<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependentInterface;

interface ProductTranslationInterface extends TranslationInterface, ShopDependentInterface
{
    /**
     * @param ProductInterface $product
     * @return $this
     */
    public function setProduct(ProductInterface $product);

    /**
     * @return ProductInterface
     */
    public function getProduct();

    /**
     * @return \ArrayAccess
     */
    public function getFiles();

    /**
     * @param ProductFileInterface $file
     * @return $this
     */
    public function addFile(ProductFileInterface $file);

    /**
     * @param \ArrayAccess $files
     * @return $this
     */
    public function setFiles($files);
}