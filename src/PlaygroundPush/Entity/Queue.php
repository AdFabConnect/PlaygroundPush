<?php

namespace PlaygroundPush\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;


/**
 * @ORM\Entity @HasLifecycleCallbacks
 * @ORM\Table(name="push_queue")
 */
class Queue implements InputFilterAwareInterface
{

    protected $inputFilter;
    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * uuid
     * @ORM\Column(type="string", nullable=false)
     */
    protected $uuid;

    /**
     * token
     * @ORM\Column(type="string", nullable=false)
     */
    protected $token;

    /**
     * badge
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $badge; 

    /**
     * alert
     * @ORM\Column(type="string", nullable=false)
     */
    protected $alert; 

    /**
     * state
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $state; 

     /**
     * message
     * @ORM\Column(type="string", nullable=true)
     */
    protected $message; 

     /**
     * retry
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $retry = 3;      

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    /**
     * @param int $id
     * @return Keyword
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
    
      /**
     * @param int $id
     * @return Keyword
     */
    public function setUUID($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return int $id
     */
    public function getUUID()
    {
        return $this->uuid;
    }

      /**
     * @param int $id
     * @return Keyword
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return int $id
     */
    public function getToken()
    {
        return $this->token;
    }

     /**
     * @param int $id
     * @return Keyword
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;

        return $this;
    }

    /**
     * @return int $id
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * @param int $id
     * @return Keyword
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return int $id
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param int $id
     * @return Keyword
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return int $id
     */
    public function getMessage()
    {
        return $this->message;
    }


    /**
     * @param int $id
     * @return Keyword
     */
    public function setRetry($retry)
    {
        $this->retry = $retry;

        return $this;
    }

    /**
     * @return int $id
     */
    public function getRetry()
    {
        return $this->retry;
    }

    /**
     * @return datetime $created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param datetime $created_at
     * return Keyword
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return datetime $updated_at
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param datetime $updated_at
     *
     * @return Keyword
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

     /** @PrePersist */
    public function createChrono()
    {
        $this->created_at = new \DateTime("now");
        $this->updated_at = new \DateTime("now");
    }

    /** @PreUpdate */
    public function updateChrono()
    {
        $this->updated_at = new \DateTime("now");
    }

    /**
    * setInputFilter
    * @param InputFilterInterface $inputFilter
    */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    /**
    * getInputFilter
    *
    * @return  InputFilter $inputFilter
    */
    public function getInputFilter()
    {
         if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $this->inputFilter = $inputFilter;
            $factory = new InputFactory();
        }
        return $this->inputFilter;
    }
}