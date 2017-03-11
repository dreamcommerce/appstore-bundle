<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator;



use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator\Types\RestRequestValidatorInterface;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationPayload;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopRepositoryInterface;
use Sylius\Component\Resource\Factory\Factory;

class RestRequestValidator extends RequestValidatorAbstract implements RestRequestValidatorInterface
{
    /**
     * @var ShopRepositoryInterface
     */
    private $shopRepository;

    /**
     * @var ShopInterface
     */
    private $shop;

    public function setShopRepository(ShopRepositoryInterface $shopRepository)
    {
        $this->shopRepository = $shopRepository;
    }

    public function validate(): ApplicationPayload
    {
        $shopHash = $this->request->request->get('shop_hash', $this->request->query->get('shop_hash', ''));

        if (strlen($shopHash) !== 128 || !preg_match('/^[a-z0-9]+$/i', $shopHash)) {
            throw new InvalidRequestException('Invalid shop hash send to application');
        }


        $shop = $this->collectShop($shopHash);
        $this->setApplication($shop->getApp());

        return new ApplicationPayload([]);
    }

    public function getShop()
    {
        return $this->shop;
    }

    private function collectShop(string $shopHash): ShopInterface
    {
        $this->shop = $this->shopRepository->findOneByHash($shopHash);

        if (!$this->shop) {
            throw new InvalidRequestException(sprintf('Shop with hash %s does not exists', $shopHash));
        }

        return $this->shop;
    }
}