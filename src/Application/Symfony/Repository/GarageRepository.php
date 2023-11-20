<?php

namespace App\Application\Symfony\Repository;

use App\Domain\Garage\Entity\Garage as DomainGarage;
use App\Application\Symfony\Entity\Garage;
use App\Domain\Garage\Repository\GarageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Garage>
 *
 * @method Garage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Garage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Garage[]    findAll()
 * @method Garage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class GarageRepository extends ServiceEntityRepository implements GarageRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, readonly private EntityManagerInterface $em)
    {
        parent::__construct($registry, Garage::class);
    }


    public function add(DomainGarage $domainGarage): void
    {
        $garage = new Garage();
        $garage->setName($domainGarage->getName());
        $garage->setSiren($domainGarage->getSiren());
        $garage->setAddress($domainGarage->getAddress());

        $this->em->persist($garage);
        $this->em->flush();
    }

    public function update(DomainGarage $garage): void
    {
        // TODO: Implement update() method.
    }

    public function remove(DomainGarage $garage, bool $flush = false): void
    {
        // TODO: Implement remove() method.
    }
}
