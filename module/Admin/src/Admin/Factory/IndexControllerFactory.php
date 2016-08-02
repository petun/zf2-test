<?php

namespace Admin\Factory;

use Admin\Controller\IndexController;
use Admin\Service\AdminService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 * Class IndexControllerFactory
 *
 * @author Petr Marochkin <petun911@gmail.com>
 */
class IndexControllerFactory implements FactoryInterface
{


    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new AdminService();
        return new IndexController($service);
    }
}