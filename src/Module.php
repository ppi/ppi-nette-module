<?php
/**
 * This file is part of the PPI Framework.
 *
 * @copyright   Copyright (c) 2014 Paul Dragoonis <paul@ppi.io>
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        http://www.ppi.io
 */

namespace PPI\LatteModule;

use PPI\Autoload;
use PPI\Framework\Module\AbstractModule;
use PPI\LatteModule\Factory\LatteWrapperFactory;
use PPI\LatteModule\Factory\LatteEngineFactory;
use PPI\LatteModule\Factory\LatteLoaderFactory;

/**
 * PPI Latte Module.
 *
 * @author Paul Dragoonis <paul@ppi.io>
 */
class Module extends AbstractModule
{

    public function getName()
    {
        return 'LatteModule';
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return ['latte' => $this->loadConfig(__DIR__.'/../resources/config.php')];
    }

    public function getServiceConfig()
    {
        return ['factories' => [
            'templating.engine.latte' => LatteWrapperFactory::class,
            'latte.engine' => LatteEngineFactory::class,
            'latte.loader' => LatteLoaderFactory::class
        ]];
    }
}
