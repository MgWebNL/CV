<?php

namespace PenD\Docker\Application\Repository;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use PenD\Docker\Application\Model\Outboundorders;
use PenD\Docker\Application\ProductionPlanning\OrderType;

/**
 * Class FrBkhAdresRepository
 * @package PenD\Docker\Application\Repository
 */
class OutboundordersRepository extends EntityRepository
{
    /**
     * @return Collection|Outboundorders[]
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getUnprocessedShipments(): array
    {
        $date = new \DateTime('2020-08-01');
//        dump($date->format('Y-m-d\TH:i:s.000')); die();

        $qb = $this->createQueryBuilder('o');
        $qb ->select('o', 'spi', 'sp', 's')

            ->innerJoin(
                'PenD\Docker\Application\Model\Shipmentpackageitems',
                'spi',
                \Doctrine\ORM\Query\Expr\Join::WITH,
                'spi.outboundorderFk = o.outboundordersPk'
            )

            ->innerJoin(
                'PenD\Docker\Application\Model\Shipmentpackages',
                'sp',
                \Doctrine\ORM\Query\Expr\Join::WITH,
                'spi.shipmentpackageFk = sp.shipmentpackagePk'
            )

            ->innerJoin(
                'PenD\Docker\Application\Model\Shipments',
                's',
                \Doctrine\ORM\Query\Expr\Join::WITH,
                'sp.shipmentFk = s.shipmentPk'
            )
            ->where('s.createdon >= :date')
            ->andWhere('s.communicationartefacts IS NULL')
            ->setParameter('date', $date->format('Y-m-d\TH:i:s.000'));

        return $qb->getQuery()
            ->getResult();
    }
}
