<?php
/**
 * Created by PhpStorm.
 * User: placeless
 * Date: 16/12/16
 * Time: 上午11:58
 */
$str =  <<< TEMPLATE



<?php 
/**
 * Create by Smartisan
 * @name %s
 * @desc Yaf定义了如下的6个Hook,插件之间的执行顺序是先进先Call
 * @see http://www.php.net/manual/en/class.yaf-plugin-abstract.php
 * @author placeless
 */
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;
use Yaf\Plugin_Abstract;
class %s extends Plugin_Abstract
{
	public function routerStartup(Request_Abstract \$request, Response_Abstract \$response) 
	{
		
	}
	public function routerShutdown(Request_Abstract \$request, Response_Abstract \$response) 
	{
		
	}
	public function dispatchLoopStartup(Request_Abstract \$request, Response_Abstract \$response) 
	{
		
	}
	public function preDispatch(Request_Abstract \$request, Response_Abstract \$response) 
	{
		
	}
	public function postDispatch(Request_Abstract \$request, Response_Abstract \$response) 
	{
		
	}
	public function dispatchLoopShutdown(Request_Abstract \$request, Response_Abstract \$response) 
	{
		
	}
}
TEMPLATE;
return $str;