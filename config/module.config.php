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
                                'controller' => 'PlaygroundPush\Controller\Api\Device',
                                'action'     => 'add',
                            ),
                        ),
                    ),
                ),
            ),
            'admin' => array(
                'child_routes' => array(
                    'playgroundpush' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/push',
                            'defaults' => array(
                                'controller' => 'PlaygroundPush\Controller\Admin\Push',
                                'action'     => 'list',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'remove' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/remove[/:pushId]',
                                    'defaults' => array(
                                        'controller' => 'PlaygroundPush\Controller\Admin\Push',
                                        'action'     => 'remove',
                                    ),
                                    'constraints' => array(
                                        'pushId' => '[0-9]*',
                                    ),
                                ),
                            ), 
                            'edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/edit[/:pushId]',
                                    'defaults' => array(
                                        'controller' => 'PlaygroundPush\Controller\Admin\Push',
                                        'action'     => 'edit',
                                    ),
                                    'constraints' => array(
                                        'pushId' => '[0-9]*',
                                    ),
                                ),
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
            'PlaygroundPush\Controller\Api\Device'   => 'PlaygroundPush\Controller\Api\DeviceController',
            'PlaygroundPush\Controller\Admin\Push'   => 'PlaygroundPush\Controller\Admin\PushController',
        ),
    ),
    'navigation' => array(
        'admin' => array(
            'push' => array(
                'label' => 'Push',
                'route' => 'admin/playgroundpush',
                'resource' => 'admin',
                'privilege' => 'list',
            ),
        ),
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