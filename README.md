ThinkPHP With Codeception Unit Tests Example
===============


ThinkPHP5.1基础框架集成Codeception单元测试：

 + 支持ThinPHP5.1自带的测试: `php think unit`指令
 + 支持PHPUnit单元测试
 + 支持Codeception单元测试（current version 3.1.2）
 + 支持composer进行更新升级框架

> ThinkPHP5的运行环境要求PHP5.6以上。

* Github项目地址： [https://github.com/lajox/thinkphp-codeception-example](https://github.com/lajox/thinkphp-codeception-example)
* bug/建议发送至邮箱：`lajox@19www.com`
* 联系作者QQ：`517544292`

## 安装

##### 下载与安装composer

+ [下载与安装](https://getcomposer.org/download/)

安装完成，可以使用

~~~
php composer.phar --version         ::获取版本信息
composer --version                  ::获取版本信息
~~~

##### 下载与安装PHPUnit 

+ [下载与安装](https://phpunit.de/getting-started/phpunit-8.html)

安装完成，可以使用

~~~
php phpunit.phar --version         ::获取版本信息
phpunit --version                  ::获取版本信息
~~~

##### 下载与安装Codeception 3

+ [下载与安装 (version: 3.1.2)](https://codeception.com/builds)

安装完成，使用命令查看版本：

~~~
php codecept.phar --version         ::获取版本信息: Codeception 3.1.2
codecept --version                  ::获取版本信息: Codeception 3.1.2
~~~

##### 项目配置:

+ 导入`sqls/testdb.sql`到数据库
+ 添加HOSTS一条记录： `127.0.0.1 www.thinkapp.com`
+ 配置Apache或Nginx服务器设置项目根目录指向`public/`目录下
+ 配置伪静态设置，比如Nginx的配置：

~~~
if (!-e $request_filename) {
	rewrite  ^(.*)$  /index.php?s=/$1  last;
	break;
}
~~~

然后就可以在浏览器中访问:
~~~
http://www.thinkapp.com
~~~

更新框架:
~~~
composer update
~~~


## 使用PHPUnit进行单元测试

~~~
phpunit tests/UnitTest.php
phpunit tests/UnitTest.php --teamcity         ::更详细信息
~~~

## 使用ThinkPHP自带的测试工具命令进行测试（内置核心使用的是PHPUnit）

~~~
php think unit
~~~

## 使用Codeception进行单元测试

support version: 3.1.2

~~~
cd tests_codecept
codecept run
codecept run unit --steps --debug
codecept run api --steps --debug
codecept run --steps --debug tests\scratch\UserTest.php
codecept run --steps --debug tests\scratch\UserTest.php:testSomeFeature
~~~

## 使用Codeception命令创建步骤

+ 首先用 `codecept bootstrap` 来初始化创建`codeception.yml`配置文件和生成几个默认的目录文件

~~~
codecept bootstrap
~~~

> 官方的解释是： This creates configuration file codeception.yml and tests directory and default test suites.

+ 我们来创建一个新目录类型： mixture ，使用命令 `generate:suite`

~~~
codecept generate:suite mixture
~~~

+ 编辑文件: `mixture.suite.yml`

~~~
actor: MixtureTester
modules:
    enabled:
        - \Helper\Mixture
        - Asserts
        - Db:
              dsn: 'mysql:host=localhost;dbname=testdb'
              user: 'root'
              password: 'root'
              dump: 'tests/_data/dump.sql'
        - PhpBrowser:
              url: http://www.thinkapp.com
        - REST:
              url: http://www.thinkapp.com
              depends: PhpBrowser
              part: Json
        - Filesystem
    step_decorators: ~
~~~

+ 修改完`yml`配置文件之后, 一般要运行`codecept build`来构建代码

~~~
codecept build
~~~

+ 创建几个单元测试文件：

~~~
codecept generate:test mixture MixUserTest
codecept generate:cest mixture MixUserCest
codecept generate:cept mixture MixUserCept
~~~

> 通常用 `generate:test`, `generate:cest`, `generate:cept` 来区分创建不同类型的单元测试文件

+ 查看运行单元测试结果 `codecept run`

~~~
codecept run mixture
codecept run mixture MixUserTest --steps --debug
~~~

#### 高级用法

+ 可以同`generate:helper`来创建助手模块文件，例如：

~~~
codecept generate:helper "Mixture\Common"
~~~

> 运行之后，将会在`tests/_support/Helper/`目录下生成`Mixture/Common.php`文件

+ 编辑文件: `mixture.suite.yml`，加入新模块引入`\Helper\Mixture\Common`

~~~
actor: MixtureTester
modules:
    enabled:
        - \Helper\Mixture
        - \Helper\Mixture\Common
        - Asserts
        - Db:
              dsn: 'mysql:host=localhost;dbname=testdb'
              user: 'root'
              password: 'root'
              dump: 'tests/_data/dump.sql'
        - PhpBrowser:
              url: http://www.thinkapp.com
        - REST:
              url: http://www.thinkapp.com
              depends: PhpBrowser
              part: Json
        - Filesystem
    step_decorators: ~
~~~

+ 修改完`yml`配置文件之后, 一般再运行`codecept build`来构建代码

~~~
codecept build
~~~

#### 更多Codeception命令：

* `generate:cept suite filename` - Generates a sample Cept scenario
* `generate:cest suite filename` - Generates a sample Cest test
* `generate:test suite filename` - Generates a sample PHPUnit Test with Codeception hooks
* `generate:phpunit suite filename` - Generates a classic PHPUnit Test
* `generate:suite suite actor` - Generates a new suite with the given Actor class name
* `generate:scenarios suite` - Generates text files containing scenarios from tests
* `generate:helper filename` - Generates a sample Helper File
* `generate:pageobject suite filename` - Generates a sample Page object
* `generate:stepobject suite filename` - Generates a sample Step object
* `generate:environment env` - Generates a sample Environment configuration
* `generate:groupobject group` - Generates a sample Group Extension

#### 安装WebDriver自动化web浏览器测试工具：

更多资料参阅 [WebDriver.md](WebDriver)
