<?php

namespace PPI\LatteModule\Factory;

use Latte\Engine as LatteEngine;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LatteEngineFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $engine = new LatteEngine();
        $engine->setLoader($serviceLocator->get('latte.loader'));
        return $engine;
    }
}