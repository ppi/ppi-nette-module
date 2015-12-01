<?php

namespace PPI\LatteModule\Loader;

use Latte\ILoader;

/**
 * Template loader.
 */
class FileLoader implements ILoader
{

    protected $locator;
    protected $parser;
    protected $loader;

    public function __construct($locator, $parser, $loader)
    {
        $this->parser = $parser;
        $this->loader = $loader;
        $this->locator = $locator;
    }

    /**
     * Returns template source code.
     * @return string
     */
    public function getContent($file)
    {

        $template = $this->parser->parse($file);
        $templatePath = $this->locator->locate($template);

        if (!is_file($templatePath)) {
            throw new \RuntimeException("Missing template file '$templatePath'.");

        } elseif ($this->isExpired($templatePath, time())) {
            touch($templatePath);
        }

        return file_get_contents($templatePath);
    }


    /**
     * @return bool
     */
    public function isExpired($file, $time)
    {
        return @filemtime($file) > $time; // @ - stat may fail
    }


    /**
     * Returns fully qualified template name.
     * @return string
     */
    public function getChildName($file, $parent = NULL)
    {
        if ($parent && !preg_match('#/|\\\\|[a-z][a-z0-9+.-]*:#iA', $file)) {
            $file = dirname($parent) . '/' . $file;
        }
        return $file;
    }

}