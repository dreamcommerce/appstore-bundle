<?php
namespace DreamCommerce\Component\ShopAppstore\Repository;

use DreamCommerce\Component\ShopAppstore\Model\Shop\Metafield;
use DreamCommerce\Component\ShopAppstore\Model\Shop\MetafieldInterface;
use DreamCommerce\Component\ShopAppstore\Model\Shop\MetafieldValue;
use DreamCommerce\Component\ShopAppstore\Model\Shop\MetafieldValueInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class MetafieldRepository extends EntityRepository
{
    const ALIAS = 'metafield';


    public function getValuesByType(Metafield $metafield, string $type): array
    {
        $metafieldValues = [];

        /** @var MetafieldValue $metafieldValue */
        foreach ($metafield->getMetafieldValues() as $metafieldValue) {
            if ($metafieldValue->getType() === $type) {
                $metafieldValues[] = $metafieldValue;
            }
        }

        return $metafieldValues;
    }

    public function removeByShop(ShopInterface $shop)
    {
        $metafields = $this->findBy(['shop'  => $shop]);

        /** @var MetafieldInterface $metafield */
        foreach ($metafields as $metafield) {
            /** @var MetafieldValueInterface $mv */
            foreach ($metafield->getMetafieldValues() as $mv) {
                $this->getEntityManager()->remove($mv);
            }

            $this->getEntityManager()->remove($metafield);
        }

        $this->getEntityManager()->flush();
    }


    public function getLastValue(Metafield $metafield, string $type=null)
    {
        $query = $this->createQueryBuilder()
            ->select('metafieldValue')
            ->from(MetafieldValue::class)
            ->andWhere('metafield=:metafield')
            ->setParameter('metafield', $metafield)
            ->orderBy('metafieldValue.id', 'DESC')
            ->setMaxResults(1)
        ;

        if ($type !== null) {
            $query
                ->where('metafieldValue.type=:type')
                ->setParameter('metafieldValue.type', $type)
            ;
        }

        $result = $query
            ->getQuery()
            ->getOneOrNullResult()
        ;

        if (empty($result)) {
            return null;
        }

        return $result;
    }
}