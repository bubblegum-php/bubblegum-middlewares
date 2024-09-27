# bubblegum-middlewares
Middlewares module for BUBBLEGUM

## Installation
Require this module with composer

`composer require bubblegum-php/bubblegum-core`

## Usage

### Create your middleware class

```php
<?php

namespace App\Middlewares;

use Bubblegum\Middlewares\Middleware;
use Bubblegum\Request;

class TestMiddleware extends Middleware
{

    public function handle(Request $request, array $data = []): string|array
    {
        // You can modify $request or data here, or make conditions
        $fromWrapped = $this->handleWrapped($request, $data); // call handle function from wrapped component
        // You can modify returned value from wrapped component
        return $fromWrapped; // return result
    }
}
```

### Wrap middleware around routed component
__File app/routes.php__
```php
// use Bubblegum middlewares down here
use Bubblegum\Middlewares\Wrapper;
use App\Middlewares\TestMiddleware;

Route::get('/',
    Wrapper::wrap(TestController::class, TestMiddleware::class)
);
```