<?php
/**
 * Created by PhpStorm.
 * User: placeless
 * Date: 16/6/7
 * Time: 下午10:31
 */
namespace Helper;
//function dir(){
//    return $baseUri = \Yaf\Registry::get('config')->application->dir;
//}
function helper(){
    echo 'helper';
}

function url($url='index/index'){
    return 'http://'.$_SERVER['HTTP_HOST'].'/'.dir().'/'.$url;
}
function asset($filepath='bower_components/jquery/jquery.js'){
    return 'http://'.$_SERVER['HTTP_HOST'].'/'.dir().'/'.$filepath;
}