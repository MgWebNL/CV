<?php

namespace PenD\Docker\Application\Repository;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use PenD\Docker\Application\Model\Shipments;
use PenD\Docker\Application\ProductionPlanning\OrderType;

/**
 * Class FrBkhAdresRepository
 * @package PenD\Docker\Application\Repository
 */
class ShipmentsRepository extends EntityRepository
{
    /**
     * @return Collection|Shipments[]
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getUnprocessedShipments(): array
    {
        $date = new \DateTime('2020-08-01');
//        dump($date->format('Y-m-d\TH:i:s.000')); die();

        $qb = $this->createQueryBuilder('u');
        $qb ->where('u.createdon >= :date')
            ->andWhere('u.communicationartefacts IS NULL')
            ->setParameter('date', $date->format('Y-m-d\TH:i:s.000'));

        return $qb->getQuery()
            ->getResult();
    }
}
