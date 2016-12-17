# 安装
1. 请确保机器已经安装了Yaf框架, 并且已经加载入PHP;
2. 把项目目录Copy到Webserver的DocumentRoot目录下;
3. 需要在php.ini里面启用如下配置，生产的代码才能正确运行：
	yaf.use_namespace=1
	yaf.use_spl_autoload=1
4. 重启Webserver;
5. 进入项目目录执行 conposer require;
6. 访问`http://yourhost/path_to_your_yaf/`,出现Hellow Word!, 表示运行成功,否则请查看php错误日志;
# 目录结构
```
+ application
+ command
+ conf
+ storage
+ vendor
- index.php
-npm install filemap.js -g
```