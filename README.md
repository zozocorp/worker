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
composer require zozocorp/worker
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
$dns = $wk->template()->minify(['template' => '<!DOCTYPE html>
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


### CONVERT HTML TO AMP
```php
$wk = Worker::create('key-example');
$dns = $wk->template()->amp(['template' => '<!DOCTYPE html>
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

### MINIFY IMAGES

C1: Use the api post header form data or push directly from the form

```php
$wk = Worker::create('key-example');
$dns = $wk->image()->shrink(['image' => $file]);
```
C2: use api post images curl

```php
$wk = Worker::create('key-example');
$dns = $wk->image()->shrink(['image' => $_FILES['image']]);
```

### GEO IP
```php
$wk = Worker::create('key-example');
$dns = $wk->ip()->info(['ip' => '125.212.192.170']);
```

You can also use the `NoopHydrator` to get a PSR7 Response returned from
the API calls.

### URL screenshot
```php
$width = 1080;
$height = 650;
$url = 'https://zozo.vn/';
$wk = Worker::create('key-example');
$dns = $wk->url()->screenshot(['url' => $url, 'width' => $width, 'height' => $height]);
```

You can also use the `NoopHydrator` to get a PSR7 Response returned from
the API calls.

### URL screenshot
```php
$width = 1080;
$height = 650;
$url = 'https://zozo.vn/';
$wk = Worker::create('key-example');
$dns = $wk->url()->screenshot(['url' => $url, 'width' => $width, 'height' => $height]);
```

You can also use the `NoopHydrator` to get a PSR7 Response returned from
the API calls.


### URL short
```php
$url = 'https://zozo.vn/';
$wk = Worker::create('key-example');
$dns = $wk->url()->screenshot(['url' => $url]);
```

You can also use the `NoopHydrator` to get a PSR7 Response returned from
the API calls.


### URL short

Search full text
```php
$wk = Worker::create('key-example');
$dns = $wk->search()->fullText(
    [
        'index' => 'index name', 
        'keyword' => 'website giáo dục' , 
        'fields' => array('text', 'title', 'description')
    ]);
```

Insert data
```php
$url = 'https://zozo.vn/';
$wk = Worker::create('key-example');
$dns = $wk->search()->insertData(
    ['index' => 'index name' ,
     'data' => array('text' => 'insert content', 'title' => 'insert content', 'description' => 'insert content')
    ]);
```

Get data
```php
$url = 'https://zozo.vn/';
$wk = Worker::create('key-example');
$dns = $wk->search()->getData(
    [
        'index' => 'index name', 
        'id' => 1 , 
    ]);
```

Delete data
```php
$url = 'https://zozo.vn/';
$wk = Worker::create('key-example');
$dns = $wk->search()->deleteData(
    [
        'index' => 'index name', 
        'id' => 1 , 
    ]);
```

Create index
```php
$url = 'https://zozo.vn/';
$wk = Worker::create('key-example');
$dns = $wk->search()->createIndex(
    [
        'index' => 'index name', 
    ]);
```

Delete index
```php
$url = 'https://zozo.vn/';
$wk = Worker::create('key-example');
$dns = $wk->search()->deleteIndex(
    [
        'index' => 'index name', 
    ]);
```

### Create QR code

TYPE: use type text (name, email, phone, url, meta)

```php
$type = 'text';
$name = 'zozo'; // Field is optional
$email = 'ws@zozo.vn'; // Field is optional
$meta = 'zozo.vn - Nền tảng thiết kế Website bán hàng chuyên nghiệp'; // Field is optional
$url = 'https://zozo.vn/'; // Field is optional
$phone = '0960099999'; // Field is optional

$wk = Worker::create('key-example');
$dns = $wk->qrCode()->encode(['type' => $type, 'content' => $meta]);
```
TYPE: use type mecard (name, address, phone, email, url)

```php
$type = 'mecard';
$name = 'zozo'; // Field is optional
$email = 'ws@zozo.vn'; // Field is optional
$address = 'Tầng 7, Toà nhà iNET, số 247 Cầu Giấy, phường Dịch Vọng, Quận Cầu Giấy'; // Field is optional
$url = 'https://zozo.vn/'; // Field is optional
$phone = '0960099999'; // Field is optional

$wk = Worker::create('key-example');
$dns = $wk->qrCode()->encode(['type' => $type, 'name' => $name, 'email' => $email, 'address' => $address, 'url' => $url, 'phone' => $phone]);
```

TYPE: use type vcard (first_name, last_name, title, company, street, province, country, phone, email, url)

```php
$type = 'vcard';
$first_name = 'le'; // Field is optional
$last_name = 'thi'; // Field is optional
$title = 'Nền tảng thiết kế Website bán hàng chuyên nghiệp'; // Field is optional
$company = 'zozo.vn'; // Field is optional
$email = 'ws@zozo.vn'; // Field is optional
$street = 'Tầng 7, Toà nhà iNET, số 247 Cầu Giấy, phường Dịch Vọng, Quận Cầu Giấy'; // Field is optional
$province = 'Hà Nội'; // Field is optional
$country = 'Việt Nam'; // Field is optional
$url = 'https://zozo.vn/'; // Field is optional
$phone = '0960099999'; // Field is optional

$wk = Worker::create('key-example');
$dns = $wk->qrCode()->encode([
    'first_name' => $first_name, 'last_name' => $last_name, 
    'title' => $title, 'company' => $company, 'email' => $email, 
    'street' => $street, 'province' => $province, 'country' => $country,
    'url' => $url, 'phone' => $phone]);
```
