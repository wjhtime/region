# region selector

#安装
1.composer安装
```
composer require proton/region 1.2;
```
2.编辑config/app.php文件,在provider节点中加入
```
Wjh/Region/RegionServiceProvider::class
```
3.命令行中执行
```
php artisan vendor:publish
```