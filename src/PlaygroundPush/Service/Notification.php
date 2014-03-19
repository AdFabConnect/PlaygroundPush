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

        // Mettre en queue 
        // Envoyer la queue
        // Si erreur retry -1
        // Si ok on enleve de la queue et on met dans notification
        // on enleve le retry à 0

        $time = time() - $timeBegin;
        $this->log("Execution time : ".($time).' seconds' , CronController::SUCCESS);
    }

  

    public function log($message, $level)
    { 
        CronController::log($message, $level);
    }

    public function getNotificationMapper()
    {
        return $this->getServiceManager()->get('playgroundpush_notification_mapper');
    }

    public function getQueueMapper()
    {
        return $this->getServiceManager()->get('playgroundpush_queue_mapper');
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