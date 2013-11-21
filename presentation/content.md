# Templating PHP
# With Twig
![UpFront Wichita](/img/upfront-logo.svg)

---
# Meet Twig
* From Sensio Labs

![Twig Logo](/img/logo-twig.png)

--
# Symfony Framework
![Symfony Framework](/img/logo-symfony.png)

--
# Silex Micro-framework
![Silex Micro-framework](/img/logo-silex.png)

--
# Swift Mailer
![Swift Mailer](/img/logo-swift-mailer.png)

--
# Sismo Testing Server
![Sismo Testing](/img/logo-sismo.jpg)

---
# Install Via Composer
![Sismo Testing](/img/logo-composer.png)

[http://getcomposer.org/](http://getcomposer.org/)

--
# Install Via Composer
~~~bash
composer require "twig/twig"
~~~

---
# The Setup
`index.php`
~~~php
require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views/');
$twig   = new Twig_Environment($loader);

echo $twig->render('index.html.twig');
// or
$twig->display('index.html.twig');
~~~

--
# The Setup
`index.html.twig`
~~~twig
<!doctype html>
<html>
  <head>
    <title>Twig Demo</title>
  </head>
  <body>
    <h1>Hello, Twig!</h1>
  </body>
</html>
~~~

---
# Let's Template!
* `{% ... %}` executes statements
* `{{ ... }}` prints result of expression

--
# Let's Template!
`index.html.twig`
~~~twig
<!doctype html>
<html>
  <head>
    <title>Twig Demo</title>
  </head>
  <body>
    {% set engine = "Twig" %}
    <h1>Hello, {{ engine }}!</h1>
  </body>
</html>
~~~

---
# Variables
`index.php`
~~~php
echo $twig->render('index.html.twig', ['engine' => someCode()]);
~~~

--
# Variables
`index.php`
~~~php
$users = $orm->findUsers();
echo $twig->render('index.html.twig', ['users' => $users]);
~~~

`index.html.twig`
~~~twig
<ul>
{% for user in users %}
  <li>{{ user.name }} is at {{ user.location }}</h1>
{% endfor %}
</ul>
~~~

--
# Variable Accessors
Twig
~~~twig
<h1>Hello, {{ user.name }}</h1>
~~~
PHP
~~~php
$user['name'];
$user->name;
$user->name();
$user->getName();
$user->isName();
NULL;
~~~

---

* filters
* macros
* functions
* not just html
* spaceless
* auto escaping
* extending layouts

---
# Caching
* Enable caching in your 

---
# Sources
* Twig, Symfony, Silex, Sismo, and Swift Mailer logos are copyright Sensio Labs
 * [http://twig.sensiolabs.org](http://twig.sensiolabs.org)
* Composer logo is from [http://wizardcat.com/](http://wizardcat.com/)
