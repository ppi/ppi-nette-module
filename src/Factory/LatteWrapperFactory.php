<?php
/**
 * This file is part of the PPI Framework.
 *
 * @copyright   Copyright (c) 2011-2013 Paul Dragoonis <paul@ppi.io>
 * @license     http://opensource.org/licenses/mit-license.php MIT
 *
 * @link        http://www.ppi.io
 */

namespace PPI\LatteModule\Factory;

use Latte\Engine as LatteEngine;
use PPI\LatteModule\Wrapper\LatteWrapper;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * LatteWrapperFactory
 *
 * @author Paul Dragoonis <paul@ppi.io>
 */
class LatteWrapperFactory implements FactoryInterface
{

    protected $defaultConfig = ['ext' => 'plate'];

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return LatteWrapper
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $engine = $serviceLocator->get('latte.engine');
        $engine->setTempDirectory($config['parameters']['app.cache_dir']);

        $latteWrapper = new LatteWrapper(
            $engine,
            $serviceLocator->get('templating.name_parser')
        );

        return $latteWrapper;
    }
}