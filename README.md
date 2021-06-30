# RabbitMQ library for Opencart

Install php-amqplib

`composer require php-amqplib/php-amqplib`

Composer path

`Composer_vendor/Opencart_dir/system/library`

Add RabbitMQ config to opencart config.php

```php
define('RABBITMQ_HOST', 'host');
define('RABBITMQ_PORT', '5672');
define('RABBITMQ_USER', 'login');
define('RABBITMQ_PASS', 'password');
```