<?php

namespace PlaygroundPush\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use ZfcBase\EventManager\EventProvider;

class Push extends EventProvider implements ServiceManagerAwareInterface
{
    
    /**
     * @var ServiceManager
     */
    protected $serviceManager;


    public function getPushMapper()
    {
        return $this->getServiceManager()->get('playgroundpush_push_mapper');
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