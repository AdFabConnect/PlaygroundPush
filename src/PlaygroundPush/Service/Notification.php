<?php

namespace PlaygroundPush\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use ZfcBase\EventManager\EventProvider;
use SyncMyTv\Cron\Cron as CronController;

class Notification extends EventProvider implements ServiceManagerAwareInterface
{
    
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    protected $mailTexte = '';


    public function send()
    {
        $timeBegin = time();
        $this->log('send Notifications '.date('d/m/Y H:i:s'), CronController::SUCCESS);

        $time = time() - $timeBegin;
        $this->log("Execution time : ".($time).' seconds' , CronController::SUCCESS);
    }

  

    public function log($message, $level)
    { 
        CronController::log($message, $level);
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