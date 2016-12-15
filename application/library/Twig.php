
<?php

class Twig implements Yaf\View_Interface
{
    private $loader;
    private $twig;
    private $variables = [];
    private $templateDir ;
    /**
     * @param string $templateDir
     * @param array  $options
     */
    public function __construct($templateDir, array $options = array())
    {
        $this->setScriptPath($templateDir);
        $this->loader = new Twig_Loader_Filesystem($templateDir);
        $this->twig   = new Twig_Environment($this->loader, $options);
    }
    public function __isset($name)
    {
        return isset($this->variables[$name]);
    }
    public function __set($name, $value)
    {
        $this->variables[$name] = $value;
    }
    public function __get($name)
    {
        return $this->variables[$name];
    }
    public function __unset($name)
    {
        unset($this->variables[$name]);
    }
    public function getTwig()
    {
    }
    public function assign($name, $value = null)
    {
        $this->variables[$name]=$value;
    }
    public function setScriptPath($templateDir)
    {
//        $this->loader->setPaths($templateDir);
        $this->templateDir = $templateDir;
    }
    public function getScriptPath()
    {
//        $paths = $this->loader->getPaths();
        return $this->templateDir;
    }
    public function render($template,  $variables = null)
    {
        if (is_array($variables)) {
            $this->variables = array_merge($this->variables,$this->variables);
        }
        return $this->twig->load($template)->display($this->variables);
    }
    public function display($template,  $variables = null)
    {
        echo $this->render($template, $variables);
    }

}