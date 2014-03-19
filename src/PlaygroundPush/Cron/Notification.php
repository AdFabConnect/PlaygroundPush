<?php
namespace PlaygroundPush\Cron;

use ZfcBase\EventManager\EventProvider;

class Notification
{
    /**
    * @var ServiceLocator $serviceLocator
    */
    protected $serviceLocator;

    public static function send()
    {
        
        $configuration = require 'config/application.config.php';
        $smConfig = isset($configuration['service_manager']) ? $configuration['service_manager'] : array();
        $sm = new \Zend\ServiceManager\ServiceManager(new \Zend\Mvc\Service\ServiceManagerConfig($smConfig));
        $sm->setService('ApplicationConfig', $configuration);
        $sm->get('ModuleManager')->loadModules();
        $sm->get('Application')->bootstrap();

        $notificationService = $sm->get('playgroundpush_notification_service');
        
        $notificationService->send(); 
    }
}