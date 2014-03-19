<?php

namespace PlaygroundPush\Mapper;

use Doctrine\ORM\EntityManager;
use ZfcBase\Mapper\AbstractDbMapper;

use PlaygroundPush\Options\ModuleOptions;

class Push
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $er;

    /**
     * @var \PlaygroundPush\Options\ModuleOptions
     */
    protected $options;


    /**
    * __construct
    * @param Doctrine\ORM\EntityManager $em
    * @param PlaygroundPush\Options\ModuleOptions $options
    *
    */
    public function __construct(EntityManager $em, ModuleOptions $options)
    {
        $this->em      = $em;
        $this->options = $options;
    }

    /**
    * findById : recupere l'entite en fonction de son id
    * @param int $id id de la keyword
    *
    * @return PlaygroundPush\Entity\Keyword $keyword
    */
    public function findById($id)
    {
        return $this->getEntityRepository()->find($id);
    }

    public function FindOneBy($array)
    {
      return $this->getEntityRepository()->FindOneBy($array);  
    }

    /**
    * findBy : recupere des entites en fonction de filtre
    * @param array $array tableau de filtre
    *
    * @return collection $keywords collection de PlaygroundPush\Entity\Keyword
    */
    public function findBy($array)
    {
        return $this->getEntityRepository()->findBy($array);
    }

    /**
    * insert : insert en base une entitÃ© keyword
    * @param PlaygroundPush\Entity\Keyword $keyword keyword
    *
    * @return PlaygroundPush\Entity\Keyword $keyword
    */
    public function insert($entity)
    {
        return $this->persist($entity);
    }

    /**
    * insert : met a jour en base une entitÃ© keyword
    * @param PlaygroundPush\Entity\Keyword $keyword keyword
    *
    * @return PlaygroundPush\Entity\Keyword $keyword
    */
    public function update($entity)
    {
        return $this->persist($entity);
    }

    /**
    * insert : met a jour en base une entitÃ© keyword et persiste en base
    * @param PlaygroundPush\Entity\Keyword $entity keyword
    *
    * @return PlaygroundPush\Entity\Keyword $keyword
    */
    protected function persist($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
    * findAll : recupere toutes les entites
    *
    * @return collection $keyword collection de PlaygroundPush\Entity\Keyword
    */
    public function findAll()
    {
        return $this->getEntityRepository()->findAll();
    }

     /**
    * remove : supprimer une entite keyword
    * @param PlaygroundPush\Entity\Keyword $keyword keyword
    *
    */
    public function remove($entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
    }

    /**
    * getEntityRepository : recupere l'entite keyword
    *
    * @return PlaygroundPush\Entity\Keyword $keyword
    */
    public function getEntityRepository()
    {
        if (null === $this->er) {
            $this->er = $this->em->getRepository('PlaygroundPush\Entity\Push');
        }

        return $this->er;
    }
}