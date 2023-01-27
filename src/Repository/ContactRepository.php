<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contact>
 *
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    public function create(array $data)
    {
        extract($data);

        $newContact = new Contact;

        $newContact
                ->setFirstName($data['first_name'])
                ->setlastName($data['last_name'])
                ->setEmail($data['email'])
                ->setCel($data['cel'])
                ->setMessage($data['message'])
                ->setContactArea($data['contact_area'])
                ->setCreatedAt(new \DateTimeImmutable());

        $this->getEntityManager()->persist($newContact);
        $this->getEntityManager()->flush();
    }

    public function findMessagesByDay($email)
    {
        $date = new \DateTimeImmutable();
        return $this->createQueryBuilder('c')
            ->where('DATE(c.created_at) = :date')
            ->andWhere('c.email = :email')
            ->setParameter('date', $date->format('Y-m-d'))
            ->setParameter('email',$email)
            ->getQuery()
            ->getResult();
    }

   
}
