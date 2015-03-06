<?php

namespace Caribbean\TourismBundle\Entity\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class POIRepository extends EntityRepository
{
    /**
     * @param $criteria
     *
     * @return array
     */
    public function findPOIByCriteria($criteria = null)
    {
        $qb = $this->createQueryBuilder('r');

        if($criteria) {
            $qb->andWhere($qb->expr()->like('r.nombre',':nombre'))
                ->setParameter('nombre', '%'.$criteria.'%');
        }

        $query = $qb->getQuery();
        try {
            return $query->getResult();
        } catch (NoResultException $e) {
            return array();
        }
    }
} 