鸟哥的[Yaf](https://github.com/laruence/yaf)
# 安装
1. 请确保机器已经安装了Yaf框架, 并且已经加载入PHP;
2. 把项目目录Copy到Webserver的DocumentRoot目录下;
3. 需要在php.ini里面启用如下配置，生产的代码才能正确运行：
	yaf.use_namespace=1
	yaf.use_spl_autoload=1
4. 重启Webserver;
5. 进入项目目录执行 conposer require;
6. 访问`http://yourhost/path_to_your_yaf/`,出现Hellow Word!, 表示运行成功,否则请查看php错误日志;
# 文档
在该工程的很多目录下都有readme.txt里面会有一些使用概述
# 目录结构
```
.
├── application
│   ├── Bootstrap.php
│   ├── controllers
│   │   ├── Error.php   //处理错误的控制器 需配置默认开启application.dispatcher.catchException = true
│   │   ├── Index.php   //默认控制器
│   │   └── readme.txt
│   ├── library      //类库文件夹，包含类库的加载规则示例
│   │   ├── DB.php
│   │   ├── Twig.php  //twig库文件 实现Yaf\View_interface
│   │   ├── helper.php //helper是工具函数类
│   │   ├── lib
│   │   ├── readme.txt
│   │   └── test.php
│   ├── models       //包含实现ORM的User.php示例 模型类使用的是laravel中使用的ORM
│   │   ├── Sample.php
│   │   ├── User.php
│   │   └── readme.txt
│   ├── modules
│   │   ├── api      //实现了一个api模块
│   │   └── readme.txt
│   ├── plugins      //插件文件夹
│   │   ├── Sample.php
│   │   └── readme.txt
│   └── views        //试图文件夹
│ 
├── conf
│   └── application.ini     //配置文件
├── command  //脚手架库文件
│   ├── GenerateControllerCommand.php
│   ├── GenerateModelCommand.php
│   ├── GeneratePluginCommand.php
│   └── templates            //脚手架模板文件夹
│       ├── controller.php
│       ├── model.php
│       └── plugin.php
├── storage
│   └── twig   //twig模板引擎缓存文件
├── vendor     //composer依赖库
├── .htaccess  //apache重写规则
├── smartisan  //脚手架工具
├── index.php  //入口文件
├── readme.md
├── composer.json
└── composer.lock
```
# 配置
配置文件 `conf/application.ini`  
如果不想使用DB可以注释掉Bootstrap.php中的_initDatabaseEloquent
# 脚手架工具
#### 用法
```
php smartisan
php smartisan create:controller {ModuleName}/{ControllerName}
php smartisan create:model  {ModelName}
php smartisan create:plugin {PluginName}
```
#### 扩充
如果想自己添加一些脚手架Command你需要:  
1. 在Command目录下编写一个GenerateXXXCommand.php(可以参照已经写好的例子)  
2. 然后在smartisan中注册这个命令
# Twig
Yaf使用其他的模板引擎需要实现Yaf\View_Interface这个Interface，然后在Bootstrap.php中注册。
使用Twig的用例，在`application\library\Twig.php`
# 使用依赖
- [illuminate/database](https://packagist.org/packages/illuminate/database) 
- [twig/twig](https://packagist.org/packages/twig/twig) 
- [filp/whoops](https://packagist.org/packages/filp/whoops) 
- [symfony/console](https://packagist.org/packages/symfony/console) 

#Last
后续会增加 seeder csrf log redis migrate   
