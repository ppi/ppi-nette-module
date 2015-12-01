<?php

namespace PPI\LatteModule\Factory;

use PPI\LatteModule\Loader\FileLoader;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LatteLoaderFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $loader = new FileLoader(
            $serviceLocator->get('templating.locator'),
            $serviceLocator->get('templating.name_parser'),
            $serviceLocator->get('templating.loader')
        );
        return $loader;
    }
}

