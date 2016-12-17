试图文件放在这里
默认采用twig
调用方式 $this->display('index/index')

如果不想使用twig 请把bootstrap.php _initView()方法中的代码给注释掉,记得修改在application.ini中的
application.view.ext='twig'