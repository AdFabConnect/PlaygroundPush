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
 * @ORM\Table(name="push_device")
 */
class Device implements InputFilterAwareInterface
{

    protected $inputFilter;
    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * token
     * @ORM\Column(type="string", nullable=false)
     */
    protected $token;

    /**
     * platform
     * @ORM\Column(type="string", nullable=false)
     */
    protected $platform; 

    /**
     * name
     * @ORM\Column(type="string", nullable=true)
     */
    protected $name; 

     /**
     * uuid
     * @ORM\Column(type="string", nullable=false)
     */
    protected $uuid; 

     /**
     * model
     * @ORM\Column(type="string", nullable=true)
     */
    protected $model; 

     /**
     * version
     * @ORM\Column(type="string", nullable=true)
     */
    protected $version; 

     /**
     * appVersion
     * @ORM\Column(type="string", name="app_version", nullable=true)
     */
    protected $appVersion; 

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
    * @param string $token
    *
    * @return Device $device
    */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }
    /**
    *
    * @return string $token
    */
    public function getToken()
    {
        
        return $this->token;
    }

    /**
    *
    * @return string $token
    */
    public function getPlatform()
    {
        
        return $this->platform;
    }

    /**
    * @param string $token
    *
    * @return Device $device
    */
    public function setPlatform($platform)
    {
        $this->platform = $platform;

        return $this;
    }
    /**
    *
    * @return string $token
    */
    public function getName()
    {
        
        return $this->name;
    }

    /**
    * @param string $token
    *
    * @return Device $device
    */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
    *
    * @return string $token
    */
    public function getUUID()
    {
        
        return $this->uuid;
    }

    /**
    * @param string $token
    *
    * @return Device $device
    */
    public function setUUID($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
    *
    * @return string $token
    */
    public function getVersion()
    {
        
        return $this->version;
    }

    /**
    * @param string $token
    *
    * @return Device $device
    */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
    *
    * @return string $token
    */
    public function getAppVersion()
    {
        
        return $this->appVersion;
    }

    /**
    * @param string $token
    *
    * @return Device $device
    */
    public function setAppVersion($appVersion)
    {
        $this->appVersion = $appVersion;

        return $this;
    }

    /**
    *
    * @return string $token
    */
    public function getModel()
    {
        
        return $this->model;
    }

    /**
    * @param string $token
    *
    * @return Device $device
    */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
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