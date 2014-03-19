<?php

namespace PlaygroundPush;

use Zend\Mvc\MvcEvent;
use Zend\Validator\AbstractValidator;
use Zend\View\Resolver\TemplateMapResolver;

class Module
{

    
    public function onBootstrap(MvcEvent $e)
    {
        $application     = $e->getTarget();
        $serviceManager  = $application->getServiceManager();
        $eventManager    = $application->getEventManager();

        $translator = $serviceManager->get('translator');

        // Gestion de la locale
        if (PHP_SAPI !== 'cli') {
            $locale = null;
            $options = $serviceManager->get('playgroundcore_module_options');
            $locale = $options->getLocale();
            $translator->setLocale($locale);

            $eventManager->getSharedManager()->attach('Zend\Mvc\Application','getCronjobs', array($this, 'addCronjob'));
        }

        AbstractValidator::setDefaultTranslator($translator,'playgroundpush');
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'aliases' => array(
                'playgroundpush_doctrine_em' => 'doctrine.entitymanager.orm_default',
            ),    
            'factories' => array(
                'playgroundpush_module_options' => function  ($sm) {
                    $config = $sm->get('Configuration');

                    return new Options\ModuleOptions(isset($config['playgroundpush']) ? $config['playgroundpush'] : array());
                },
                
                'playgroundpush_device_mapper' => function  ($sm) {
                    return new Mapper\Device($sm->get('playgroundpush_doctrine_em'), $sm->get('playgroundpush_module_options'));
                },

            ),
            'invokables' => array(
                'playgroundpush_device_service'        => 'PlaygroundPush\Service\Device',
                'playgroundpush_notification_service'  => 'PlaygroundPush\Service\Notification',
            ),
        );
    }

    /*public function addCronjob($e)
    {
        $cronjobs = $e->getParam('cronjobs');
        $cronjobs['notifications_send'] = array(
            'frequency' => '* * * * *',
            'callback'  => '\PlaygroundPush\Cron\Notification::send',
            'args'      => array(),
        );
        return $cronjobs;
    }*/
        
}