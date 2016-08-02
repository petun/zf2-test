<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

use Admin\Model\Product;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/admin',
                    'defaults' => [
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ],
                ],
            ],
            'product-create' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/admin/product/create',
                    'defaults' => [
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'create',
                    ],
                ],
            ],
            'product-edit' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route'    => '/admin/product/:id',
                    'constraints' => array(
                        'id' => '[0-9]+'
                    ),
                    'defaults' => [
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'edit',
                    ],
                ],
            ]
        ]
    ],
    'controllers' => [
        'invokables' => [

        ],
        'factories' => [
            'Admin\Controller\Index' => 'Admin\Factory\IndexControllerFactory'
        ]
    ],


    'view_manager' => [
        'template_path_stack' => [
            'admin' => __DIR__ . '/../view',
        ],
    ],

    'service_manager' => [
        'invokables' => [
            'adminService' => 'Admin\Service\AdminService'
        ],
        'factories' => array(
            'Admin\Model\ProductTable' =>  function($sm) {
                /** @var \Zend\ServiceManager\ServiceManager $sm */
                $tableGateway = $sm->get('ProductTableGateway');
                $table = new \Admin\Model\ProductTable($tableGateway);
                return $table;
            },
            'ProductTableGateway' => function ($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype = new ResultSet();
                $resultSetPrototype->setArrayObjectPrototype(new Product());
                return new TableGateway('product', $dbAdapter, null, $resultSetPrototype);
            },
        ),
    ]
];
