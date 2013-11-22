# Templating PHP
# With Twig
![UpFront Wichita](/img/upfront-logo.svg)

---
# Meet Twig
From Sensio Labs

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
PHP
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
PHP
~~~php
echo $twig->render('index.html.twig', ['engine' => someCode()]);
~~~

--
# Variables
PHP
~~~php
$users = $orm->findAllUsers();
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
# Filters
Twig
~~~twig
<h1>Hello, {{ user.name|upper|reverse }}!</h1>
~~~

HTML
~~~twig
<h1>Hello, BOCAJ!</h1>
~~~

--
# Filters
Lots of built in filters
~~~plain
abs, batch, capitalize, convert_encoding, date, date_modify,
default, escape, first, format, join, json_encode, keys, last,
length, lower, nl2br, number_format, merge, upper, raw, replace,
reverse, slice, sort, split, striptags, title, trim, url_encode
~~~

--
# Define Your Own
PHP
~~~php
$barcode128 = new \Twig_SimpleFilter('barcode128', function($string) {
  $id = md5(microtime(true));
  $path = '/tmp/barcode.' . $id . '.png';

  // Generate barcode png
  imagepng(\TimeIPS\barcode128($string), $path);
  // Fetch contents for data URI.
  $imageData = file_get_contents($path);
  // Clean up after ourselves
  unlink($path);

  return sprintf(
    "<img src='data:image/png;base64,%s'>",
    base64_encode($imageData)
  );
});
$twig->addFilter($barcode128);
~~~

--
# Define Your Own
Twig
~~~twig
<dl>
{% for job in jobs %}
  <dt>{{ job.name }}</dt>
  <dd>{{ job.code|barcode128|raw }}</dd>
{% endfor %}
</dl>
~~~

---
# Escaping
Twig can automatically escape variable output

Or you can do it by hand.
~~~twig
{{ user.name|escape }}
{{ user.name|e }}
{{ user.name|e('js') }}
~~~

---
# Macros
Similar to PHP functions

`forms.html.twig`
~~~twig
{% macro input(label, name, value="", type="text") %}
  <label for="{{ name }}">{{ label }}</label>
  <input type="{{ type }}" name="{{ name }}" id="{{ name }}" value="{{ value|e }}" />
{% endmacro %}
~~~

`index.html.twig`
~~~twig
{% import "forms.html.twig" as forms %}

{{ forms.input("Username:", "username") }}
~~~

---
# Functions
Several built in functions for common tasks
~~~text
attribute, block, constant, cycle, date, dump, include, parent,
random, range, source, template_from_string
~~~

---
# Extending Layouts
`base.html.twig`
~~~twig
<!DOCTYPE html>
<html>
  <head>
    {% block head %}
      <link rel="stylesheet" href="style.css" />
      <title>{% block title %}{% endblock %} - My Webpage</title>
    {% endblock %}
  </head>
  <body>
    <div id="content">{% block content %}{% endblock %}</div>
    <div id="footer">
      {% block footer %}
        &copy; Copyright 2013 Acme Co
      {% endblock %}
    </div>
  </body>
</html>
~~~

--
# Extending Layouts
`index.html.twig`
~~~twig
{% extends "base.html.twig" %}

{% block title %}Index{% endblock %}

{% block content %}
  <h1>Index</h1>
  <p>Lorem ipsum ...</p>
{% endblock %}

{% block footer %}
  {{ parent() }}
  <!-- Add my own script tags and stuff -->
{% endblock %}
~~~

---
# Whitespace
Twig
~~~twig
{% spaceless %}
    <ul>
    {% for user in users %}
        <li>
            <a href="/users/{{ user.id }}">{{ user.name }}</a>
        </li>
    {% endfor %}
    </ul>
{% endspaceless %}
~~~

HTML
~~~html
<ul><li><a href="/users/1">Jacob Walker</a><a href="/users/2">Anna Walker</a></li></ul>
~~~

---
# Caching
Enable caching of compiled templates in your PHP code.
~~~php
$loader  = new Twig_Loader_Filesystem('views/');
$options = ['cache' => 'var/cache/twig/'];
$twig    = new Twig_Environment($loader, $options);
~~~

---
# Not Just HTML
Twig
~~~twig
<?xml version="1.0"?>
<roster>
{% for user in users %}
  <user id="{{ user.id }}" name="{{ user.name }}" />
{% endfor %}
</roster>
~~~

XML
~~~xml
<?xml version="1.0"?>
<roster>
  <user id="1" name="Jacob Walker" />
  <user id="2" name="Anna Walker" />
</roster>
~~~

---
# Sources
* Twig, Symfony, Silex, Sismo, and Swift Mailer logos are copyright Sensio Labs
 * [http://twig.sensiolabs.org](http://twig.sensiolabs.org)
* Composer logo is from [http://wizardcat.com/](http://wizardcat.com/)
