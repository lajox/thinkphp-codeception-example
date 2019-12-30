WebDriver: 自动化web浏览器测试工具
===============

### 软件安装

#### Selenium安装

* 下载地址： [https://selenium.dev/downloads/](https://selenium.dev/downloads/)
* 下载地址： [http://docs.seleniumhq.org/download/](http://docs.seleniumhq.org/download/)
* 中文介绍： [http://www.selenium.org.cn](http://www.selenium.org.cn)

> **★ 安装Selenium Server**

* 首先我们安装 Selenium Server (Grid)，这里我们下载： [Latest stable version 3.141.59](https://bit.ly/2TlkRyu)

> 下载安装Internet Explorer Driver Server

* [32 bit Windows IE](https://selenium-release.storage.googleapis.com/3.150/IEDriverServer_Win32_3.150.1.zip)
* [64 bit Windows IE](https://selenium-release.storage.googleapis.com/3.150/IEDriverServer_x64_3.150.1.zip)

> 下载安装selenium IDE

* 下载地址： [https://selenium.dev/selenium-ide/](https://addons.mozilla.org/en-US/firefox/addon/selenium-ide/)
* For Firefox： [https://addons.mozilla.org/en-US/firefox/addon/selenium-ide/](https://addons.mozilla.org/en-US/firefox/addon/selenium-ide/)
* For Google： [https://chrome.google.com/webstore/detail/selenium-ide/mooikfkahbdckldjjndioackbalphokd](https://chrome.google.com/webstore/detail/selenium-ide/mooikfkahbdckldjjndioackbalphokd)
* 安装教程参考： https://www.cnblogs.com/xiaxiaoxu/p/8907212.html
* 使用教程参考： http://www.selenium.org.cn/1954.html

> ★ 安装Selenium Client

* 官网下载： [https://selenium.dev/downloads/](https://selenium.dev/downloads/)

###### 以Python为例, 安装selenium python client:

> a、通过pip 安装

~~~
python -m pip install selenium
~~~

> b、通过下载包安装

* 直接下载selenium包： [https://pypi.org/project/selenium/](https://pypi.org/project/selenium/)
* 解压，cmd进入目录执行:  `python setup.py install`


#### ★ 安装chromedriver

> 安装chrome chromedriver

* 官网下载地址： [https://sites.google.com/a/chromium.org/chromedriver/getting-started](https://sites.google.com/a/chromium.org/chromedriver/getting-started)
* 备用下载地址： [https://npm.taobao.org/mirrors/chromedriver/](https://npm.taobao.org/mirrors/chromedriver/)
* 安装教程参考： https://www.cnblogs.com/kite123/p/11395516.html

#### ★ 安装geckodriver

> 安装firefox geckodriver

* 下载地址： [https://github.com/mozilla/geckodriver/releases](https://github.com/mozilla/geckodriver/releases)

#### 安装Edge webdriver

* 下载地址： [https://developer.microsoft.com/en-us/microsoft-edge/tools/webdriver/](https://developer.microsoft.com/en-us/microsoft-edge/tools/webdriver/)

#### 安装Safari webdriver

* 下载地址： [https://webkit.org/blog/6900/webdriver-support-in-safari-10/](https://webkit.org/blog/6900/webdriver-support-in-safari-10/)	

#### ★ 安装PhantomJS

> PhantomJS安装

* 官方下载地址： [https://phantomjs.org/download.html](https://phantomjs.org/download.html)
* 安装教程参考： http://www.topfe.cn/javascript/322.html

~~~
打开CMD命令行工具，切换到你的当前目录，敲入phantomjs hello.js
或双击打开phantomjs.exe在窗口里输入  console.log('Hello, world!'); phantom.exit();
~~~

### 软件后台运行

#### selenium运行

* 参考文档： [https://codeception.com/docs/modules/WebDriver](https://codeception.com/docs/modules/WebDriver)

运行Selenium的前提是先安装好Java, Chrome, Firefox等软件环境。
比如我下载的是`selenium-server-standalone-3.141.59.jar`,
在同一目录下新建一个bat文件，比如: `selenium-server.bat` , 写入下面代码（默认端口4444，可以加参数：`-port 4445`来指定端口4445）：
更多运行参数介绍： [https://selenium.dev/documentation/en/grid/setting_up_your_own_grid/](https://selenium.dev/documentation/en/grid/setting_up_your_own_grid/)

~~~
:: selenium-server.bat
:: @java %* -jar "%~dp0selenium-server-standalone-3.141.59.jar" -port 4444
@java %* -jar "%~dp0selenium-server-standalone-3.141.59.jar"
~~~

定位Chromedriver:

~~~
:: selenium-server-chromedriver.bat
:: @java -Dwebdriver.chrome.driver=./chromedriver.exe -jar "%~dp0selenium-server-standalone-3.141.59.jar"
@java -Dwebdriver.chrome.driver=D:\Java\selenium-server\chromedriver.exe -jar "%~dp0selenium-server-standalone-3.141.59.jar"
~~~

定位Geckodriver:

~~~
:: selenium-server-geckodriver.bat
:: @java -Dwebdriver.gecko.driver=./geckodriver.exe -jar "%~dp0selenium-server-standalone-3.141.59.jar"
@java -Dwebdriver.gecko.driver=D:\Java\selenium-server\geckodriver.exe -jar "%~dp0selenium-server-standalone-3.141.59.jar"
~~~

* 最好把chromedriver.exe拷贝到火狐的安装目录下，比如： `C:\Program Files (x86)\Google\Chrome\Application\`
* 最好把geckodriver.exe拷贝到火狐的安装目录下，比如： `D:\Program Files (x86)\Mozilla Firefox\`
* 把路径`C:\Program Files (x86)\Google\Chrome\Application` 和 `D:\Program Files (x86)\Mozilla Firefox` 添加到环境变量`Path`里。
* 把存放`selenium-server-standalone-3.141.59.jar`的当前目录`D:\Java\selenium-server`添加到环境变量`Path`里。
* 最后运行`selenium-server.bat`文件，比如CMD窗口运行： `start cmd /c "D:\Java\selenium-server\selenium-server.bat"`

修改`*.suite.yml`配置文件，增加`url`和`browser`参数:

~~~
 modules:
       enabled:
          - WebDriver:
             url: 'http://localhost/'
             browser: chrome # 'chrome' or 'firefox'
             port: 4444 # 注意： selenium-server运行默认的端口是 4444
~~~

* ChromeDriver独立运行

在同一目录下新建一个bat文件，比如: `run-chromedriver.bat` , 写入下面代码：

~~~
:: run-chromedriver.bat
@chromedriver %* --url-base=/wd/hub
~~~

修改`yml`配置文件，配置ChromeDriver端口，比如在`_envs/chrome.yml`写入:

~~~
# `chrome` environment config goes here
modules:
  config:
    WebDriver:
      browser: 'chrome'
      url: 'http://localhost/'
      port: 9515 # 注意： chromedriver独立运行默认的端口是 9515,  而selenium-server运行默认的端口是 4444
      window_size: false # disabled in ChromeDriver
      capabilities:
        browserName: 'chrome'
        platform: ANY
#        chromeOptions:  # chromeOptions or 'goog:chromeOptions'
#          args:
#            - '--disable-web-security'
~~~

* PlantomJs运行

在同一目录下新建一个bat文件，比如: `run-phantomjs.bat` , 写入下面代码：

~~~
:: run-phantomjs.bat
phantomjs --webdriver=4444
~~~

修改`yml`配置文件，增加`url`和`browser`参数，比如在`_envs/phantom.yml`写入:

~~~
# `phantom` environment config goes here
modules:
  config:
    WebDriver:
      browser: 'phantomjs'
      port: 4444 # 注意： PlantomJs运行默认的端口是 4444
      url: 'http://localhost/'
~~~

* geckodriver运行

~~~
geckodriver一般不做单独运行， 一般是在selenium server下面运行调用
~~~

修改`yml`配置文件，比如在`_envs/firefox.yml`写入:

~~~
# `firefox` environment config goes here
modules:
  config:
    WebDriver:
      browser: 'firefox'
      port: 4444
      url: 'http://localhost/'
      capabilities:
        browserName: 'firefox'
        platform: ANY
~~~

然后通过增加`--env`参数来执行不同的环境测试：

~~~
codecept run acceptance --env phantom
codecept run acceptance --env phantom --env chrome --env firefox
codecept run acceptance --env dev,phantom --env dev,chrome --env dev,firefox
~~~

可以通过`codecept generate:env`创建各个环境配置文件：

~~~
codecept g:env phantom
codecept g:env chrome
codecept g:env firefox
~~~
