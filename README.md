# laravel-admin
Backstage management of laravel

## 安装
composer require "lizyu/permission"
composer require "lizyu/admin"

## 使用
 #### 需要删除Laravel自带的User table 启用新的user结构T
 ### 首先安装permission [lizyu/permission](https://github.com/yanwenwu/laravel-permission).
 1. 添加服务 在confit/app.php “providers”数组加入  Lizyu\Admin\LizAdminServiceProvider::class服务
 2. 发布静态资源 php artisan vendor:publish --provider="Lizyu\Admin\LizAdminServiceProvider" --tag="admin.assets"
 3. 发布配置文件以及migration php artisan vendor:publish --provider="Lizyu\Admin\LizAdminServiceProvider" --tag="admin.config"
 4. 填充数据 之前需要composer dump-autoload 然后 php artisan db:seed --class=UsersTableSeeder
 5. 直接访问后台  **域名/login**

## 注意点
1. 后台使用的H+UI， 所以你需要继续开发，就需要去下载一套， 网上资源很多
2. 本后台没有进行任何封装， 只是单纯的CURD页面，无需增加学习成本， 你只需要在在app开发目录进行开发就可以了
3. 填充的数据是具有任何权限的超级用户， 以便你之后添加任何数据, 填充的是权限管理


