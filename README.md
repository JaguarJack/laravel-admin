# laravel-admin
Backstage management of laravel

## 安装
composer require "lizyu/permission"
composer require "lizyu/admin"

## 使用
1.发布静态资源 php artisan vendor:publish --provider="Lizyu\Admin\LizAdminServiceProvider" --tag="lizyu.assets"
2.发布配置文件以及migration php artisan vendor:publish --provider="Lizyu\Admin\LizAdminServiceProvider" --tag="lizyu.config"
3.填充一条数据
4.直接访问后台

## 注意点
后台使用的H+UI， 所以你需要继续开发，就需要去下载一套， 网上资源很多
本后台没有进行任何封装， 只是单纯的CURD页面，无需增加学习成本， 你只需要在在app开发目录进行开发就可以了

