DomainText
===========

Register texts of domain and get a text (like gettext).

[![Build Status](https://travis-ci.org/kumatch/php-domaintext.png?branch=master)](https://travis-ci.org/kumatch/php-domaintext)



Install
-----

Add "kumatch/domaintext" as a dependency in your project's composer.json file.


    {
      "require": {
        "kumatch/domaintext": "*"
      }
    }

And install your dependencies.

    $ composer install


Usage
----

```php
<?php
use Kumatch\DomainText\Registry;

$domainName = "my_domain";
$registry->register($domainName, array(
    "name" => "foo",
    "item" => "apple",
    10 => 100,
    0 => "zero"
));

$domain = $registry->getDomain($domainName);

$name = $domain->get("name"); // $name = "foo"
$item = $domain->get("item"); // $item = "apple"
$num  = $domain->get(10);     // $num  = 100
$zero = $domain->get(0);      // $zero = "zero"

$person = $domain->get("person") // $person = "person", not blank or null.
```



Methods
----

### Kumatch\DomainText\Registry

#### register ( $domainName, array $texts = array() )

Register texts for domain.

#### getDomain ( $domainName, $mutable = false )

Get `Kumatch\DomainText\ImmutableDomain` instance of registerd names domain.
if runs with `$mutable = true`, get `Kumatch\DomainText\MutableDomain` instance of registerd names domain.

#### load ($filename)

Load file and register any domains.

* INI format (ex. domains.ini)
* JSON format (ex. domains.json)
* YAML format (ex. domains.yml, domains.yaml)


### Kumatch\DomainText\ImmutableDomain
### Kumatch\DomainText\MutableDomain

#### get ( $text )

Returns text of domain.

#### count

Returns count of reigstered text.


#### set ( $text, $result )

***(MutableDomain only)***

Set a text and result text for this domain.


License
--------

Licensed under the MIT License.

Copyright (c) 2013 Yosuke Kumakura

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
