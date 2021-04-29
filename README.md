# Worker PHP client

This is the Worker PHP SDK. This SDK contains methods for easily interacting
with the Worker API. Below are examples to get you started. For additional
examples, please see our official documentation at https://worker.zozo.vn/

[![Join the chat at https://gitter.im/worker/worker-php](https://badges.gitter.im/worker/worker-php.svg)](https://gitter.im/worker/worker-php?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

## Installation

To install the SDK, you will need to be using [Composer](http://getcomposer.org/)
in your project.
If you aren't using Composer yet, it's really simple! Here's how to install
composer:

```bash
curl -sS https://getcomposer.org/installer | php
```

The Worker API Client is not hard coupled to Guzzle, Buzz or any other library that sends
HTTP messages. Instead, it uses the [PSR-18](https://www.php-fig.org/psr/psr-18/) client abstraction.
This will give you the flexibility to choose what
[PSR-7 implementation and HTTP client](https://packagist.org/providers/php-http/client-implementation)
you want to use.

If you just want to get started quickly you should run the following command:

```bash
composer require worker/worker-php kriswallsmith/buzz nyholm/psr7
```

## Usage

You should always use Composer autoloader in your application to automatically load
your dependencies. All the examples below assume you've already included this in your
file:

```php
require 'vendor/autoload.php';
use Worker\Worker;
```

Here's how to send a message using the SDK:

```php
// First, instantiate the SDK with your API credentials
$wk = Worker::create('key-example'); // For VI servers

// Now, compose and send your message.
// $wk->messages()->send($domain, $params);
$wk->email()->send('example.com', [
  'from'    => 'bob@example.com',
  'to'      => 'sally@example.com',
  'subject' => 'The PHP SDK is awesome!',
  'text'    => 'It is so simple to send a message.'
]);
```

Attention: `$domain` must match to the domain you have configured on [worker.zozo.vn](https://worker.zozo.vn).

### All usage examples

You will find more detailed documentation at [/doc](https://worker.zozo.vn/frontend/docs/api/v1) and on
[https://documentation.worker.com](https://worker.zozo.vn/frontend/docs/api/v1).

### VERIFY EMAIL
```php
$wk = Worker::create('key-example');
$dns = $wk->email()->verify(['email' => 'ws@zozo.vn']);
```

If you'd rather work with an array than an object you can inject the `ArrayHydrator`
to the Worker class.

### MINIFY

The result of an API call is, by default, a domain object. This will make it easy
to understand the response without reading the documentation. One can just read the
doc blocks on the response classes. This provides an excellent IDE integration.

### MINIFY HTML
```php
$wk = Worker::create('key-example');
$dns = $wk->teamplate()->minify(['teamplate' => '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONVERT HTML TO AMP</title>
</head>
<body>
    <p>MINIFY HTML</p>
</body>
</html>']);
```

If you'd rather work with an array than an object you can inject the `ArrayHydrator`
to the Worker class.

### MINIFY IMAGES
```php
$wk = Worker::create('key-example');
$dns = $wk->minify()->shrink(['image' => $file]);
```

### CONVERT HTML TO AMP
```php
$wk = Worker::create('key-example');
$dns = $wk->teamplate()->AMP(['teamplate' => '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONVERT HTML TO AMP</title>
</head>
<body>
    <p>CONVERT HTML TO AMP</p>
</body>
</html>']);
```

If you'd rather work with an array than an object you can inject the `ArrayHydrator`
to the Worker class.

### GEO IP
```php
$wk = Worker::create('key-example');
$dns = $wk->ip()->info(['ip' => '125.212.192.170']);
```

You can also use the `NoopHydrator` to get a PSR7 Response returned from
the API calls.
