<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/admin/[:action/]',
                    'constrains' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // API routes
            'authors' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/api/authors/[:id/]',
                    'constrains' => array(
                        'id' => '[0-9]*'
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\ApiAuthors',
                        'action'     => 'index',
                    ),
                ),
            )
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\ApiAuthors' => 'Admin\Controller\ApiAuthorsController'
        ),
    ),
    'module_layouts' => array(
        'Admin' => 'layout/admin-layout'
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
