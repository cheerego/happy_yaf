<?php

/**
 * Created by PhpStorm.
 * User: placeless
 * Date: 16/12/16
 * Time: 下午11:53
 */
namespace T;
/**
 * Class Test
 * @package T
 * 像这种有namespace 但是目录结构不对的class  yaf是无法自动加载的，所以需要在bootstrap中手动加载
 */
class Test
{
    function __construct()
    {
        echo 'test';
    }

}