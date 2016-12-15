<?php

/**
 * @name Bootstrap
 * @author placeless
 * @desc 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends Yaf\Bootstrap_Abstract
{

    public function _initConfig()
    {
        //把配置保存起来
        $arrConfig = Yaf\Application::app()->getConfig();
        Yaf\Registry::set('config', $arrConfig);


    }

    public function _initLoader()
    {
        /**
         *  Yaf\Loader::import是根据路径引入
         *  Yaf\Loader::getInstance()->autoload 在library目录下的的路径
         *  没有namespace的DB默认引入
         *  namespace为lib\a\ 的路径一定要写对如class Haha
         */
        Yaf\Loader::import(APPLICATION_PATH . "/vendor/autoload.php");
        Yaf\Loader::getInstance()->autoload('helper');
    }

    public function _initWhoops(Yaf\Dispatcher $dispatcher){
        if (Yaf\Registry::get('config')->whoops->handler) {

            $run     = new Whoops\Run;
            $handler = new \Whoops\Handler\PrettyPageHandler();
            $run->pushHandler($handler);
            if (Whoops\Util\Misc::isAjaxRequest()) {
                $run->pushHandler(new \Whoops\Handler\JsonResponseHandler());
            }
            $run->register();
        }

    }
    public function _initPlugin(Yaf\Dispatcher $dispatcher)
    {
        //注册一个插件
        $objSamplePlugin = new SamplePlugin();
        $dispatcher->registerPlugin($objSamplePlugin);
    }

    public function _initDatabaseEloquent()
    {
        $dbconfig = Yaf\Registry::get("config")->mysql->toArray();
        $capsule = new Illuminate\Database\Capsule\Manager();
        $capsule->addConnection($dbconfig);
        $capsule->bootEloquent();
        $capsule->setAsGlobal();

    }

    public function _initRoute(Yaf\Dispatcher $dispatcher)
    {
        //在这里注册自己的路由协议,默认使用简单路由

    }


    public function _initView(Yaf\Dispatcher $dispatcher)
    {
        //在这里注册自己的view控制器，例如smarty,firekylin

//        Twig_Autoloader::register();
//
//        $loader = new Twig_Loader_Filesystem(Yaf\Registry::get('config')->twig->view->dir);
//        $twig = new Twig_Environment($loader, array(
//            'cache' => Yaf\Registry::get('config')->twig->cache->dir,
//            'debug'=>Yaf\Registry::get('config')->twig->debug
//        ));
//        $template = $twig->load($view);
//        $template->display($this->assign);

        $twig = new Twig(APPLICATION_PATH . '/application/views', Yaf\Registry::get('config')->twig->toArray());
        $dispatcher->setView($twig);
    }


}
