Extended Yii 2 shop example project with dependent attributes and online payment
==========================
Demo:

adminpanel :
http://an128z56.000webhostapp.com/mymarket/backend/web/index.php/site/login

login: admin
password : avs03021998

website:
http://an128z56.000webhostapp.com/mymarket/frontend/web/index.php

INSTALLATION
------------

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install the application using the following command:

~~~
git clone https://github.com/samdark/yii2-shop.git
composer self-update
composer global require "fxp/composer-asset-plugin:~1.1.1"
cd yii2-shop
composer install
~~~


GETTING STARTED
---------------

After you install the application, you have to conduct the following steps to initialize
the installed application. You only need to do these once for all.

1. Run command `init` to initialize the application with a specific environment.
2. Create a new database and adjust the `components['db']` configuration in `common/config/main-local.php` accordingly.
3. Apply migrations with console command `yii migrate`. This will create tables needed for the application to work.
4. Set document roots of your Web server:

- for frontend `/path/to/yii2shop/frontend/web/` and using the URL `http://shop.local/`
- for backend `/path/to/yii2shop/backend/web/` and using the URL `http://admin.shop.local/`

if you upload project on hosting:
       in backend\views\layouts\main.php   change link for website(frontend) : /main_folder/frontend/web
	   (for example:  http://shopdemo2.epizy.com/demoshop3/frontend/web/   link: 'Website' => '/demoshop3/frontend/web' )

To login into the application, you need to first sign up, with any of your email address, username and password.
Then, you can login into the application with same email address and password at any time.

