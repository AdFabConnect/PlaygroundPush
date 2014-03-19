<?php

namespace PlaygroundPush\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use ZfcBase\EventManager\EventProvider;

class Device extends EventProvider implements ServiceManagerAwareInterface
{
    
    /**
     * @var ServiceManager
     */
    protected $serviceManager;


    public function getDeviceMapper()
    {
        return $this->getServiceManager()->get('playgroundpush_device_mapper');
    }

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param  ServiceManager $serviceManager
     * @return User
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;

        return $this;
    }

}