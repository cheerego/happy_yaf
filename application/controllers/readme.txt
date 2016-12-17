控制器文件放在这里
1.如果没设置模块 访问方式/{controller}/{action}

2.如果设置了模块需要在 application.ini中设置
如:注册一个叫api模块(一定得包含Index)
application.modules='Index,Api'

3.可以使用脚手架工具生成
php smartisan create:controller {ModuleName}/{ControllerName}