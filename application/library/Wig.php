<?php

/**
 * http://php.net/manual/zh/class.yaf-view-simple.php
 * http://php.net/manual/zh/yaf-dispatcher.setview.php
 */
class Wig implements Yaf\View_Interface
{
    private $variable;
    private $twig;
    private $templateDir;

    function __construct($templateDir, $templateConfig = [])
    {
        $loader = new Twig_Loader_Filesystem($templateDir);
        $this->twig = new Twig_Environment($loader, $templateConfig);
        if (null !== $templateDir) {
            $this->setScriptPath($templateDir);
        }
    }

    function assign($name, $value = [])
    {
        $this->variable[$name] = $value;
    }


    function display($view, $tpl_vars = [])
    {
        echo $this->render($view, $tpl_vars);
    }

    function render($view, $tpl_vars = [])
    {
        $this->twig->load($view)->display(array_merge($this->variable, $tpl_vars));

    }

    function getScriptPath()
    {
        return $this->templateDir;
    }


    function setScriptPath($templateDir)
    {
        if (is_readable($templateDir)) {
            $this->templateDir = $templateDir;
            return;
        }

        throw new Exception('Invalid path provided');
    }

    function __set($name, $value)
    {
        $this->variable[$name] = $value;
    }

    function __get($name)
    {
        return $this->variable[$name];
    }

    function __isset($name)
    {
        return isset($this->variable);
    }

    function clear($name = null)
    {
        if (empty($name)) {
            unset($this->variable);
        } else {
            unset($this->variable[$name]);
        }
    }

    function __unset($name)
    {
        unset($this->variable[$name]);
    }

    function assignRef($name, &$value)
    {
        $this->variable[$name] = $value;
    }
}