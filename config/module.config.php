<?php

/**
* @package : PlaygroundPush
* @author : troger
* @since : 19/03/2013
*
* Configuration pour PlaygroundPush
**/

return array(
    'doctrine' => array(
        'driver' => array(
            'playgroundpush_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => __DIR__ . '/../src/PlaygroundPush/Entity'
            ),
            'orm_default' => array(
                'drivers' => array(
                    'PlaygroundPush\Entity'  => 'playgroundpush_entity',
                )
            )
        )
    ),
    'router' => array(
        'routes' => array(
            'api' => array(
                'child_routes' => array(
                    'add-device' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/add-device',
                            'defaults' => array(
                                'controller' => 'SyncMyTv\Controller\Api\Device',
                                'action'     => 'add',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        )
    ),
    'controllers' => array(
        'invokables' => array(
        ),
    ),
    'navigation' => array(
    ),
    'translator' => array(
        'locale' => 'fr_FR',
        'translation_file_patterns' => array(
            array(
                'type'         => 'phpArray',
                'base_dir'     => __DIR__ . '/../language',
                'pattern'      => '%s.php',
                'text_domain'  => 'playgroundpush'
            ),
        ),
    ),
);