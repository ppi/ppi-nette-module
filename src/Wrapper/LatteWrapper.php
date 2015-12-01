<?php

namespace PPI\LatteModule\Wrapper;

use PPI\Framework\View\EngineInterface;
use Latte\Engine as LatteEngine;
use Symfony\Component\HttpFoundation\Response;

class LatteWrapper implements EngineInterface
{

    /**
     * @var LatteEngine
     */
    protected $engine;

    protected $parser;

    /**
     *
     * @todo - make sure LatteEngine has ->setFileExtension('.latte') as default ext
     * @todo - make this setting configurable
     * @param LatteEngine $engine
     */
    public function __construct(LatteEngine $engine, $parser)
    {
        $this->engine = $engine;
        $this->parser = $parser;
    }

    /**
     * @param $name
     * @param array $parameters
     * @return string
     */
    public function render($name, array $parameters = array())
    {
        $result = $this->engine->renderToString($name, $parameters);
        return $result;
    }

    /**
     * @param $name
     * @return bool
     */
    public function exists($name)
    {
        return $this->engine->exists($name);
    }

    /**
     * @param $name
     * @return bool
     */
    public function supports($name)
    {
        $template = $this->parser->parse($name);
        return 'latte' === $template->get('engine');
    }

    /**
     * @param $name
     * @param array $parameters
     * @param Response|null $response
     * @return Response
     */
    public function renderResponse($name, array $parameters = array(), Response $response = null)
    {
        if (null === $response) {
            $response = new Response();
        }

        $response->setContent($this->render($name, $parameters));

        return $response;
    }

}