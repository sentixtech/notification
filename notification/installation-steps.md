# Laravel Alert Notification Plugin - Installation Steps

## Step 1: Register Service Provider

Add this line in your main Laravel application's `config/app.php` file in the `providers` array:

```php
'providers' => [
    // Other providers...
    AlertNotification\AlertNotificationServiceProvider::class,
],
```

## Step 2: Add to Composer Autoload

In your main Laravel application's `composer.json`, add this repository:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "./modules/AlertNotification"
        }
    ],
    "require": {
        "alertnotification/laravel-plugin": "*"
    }
}
```

Then run: `composer install`

## Step 3: Publish Configuration

```bash
php artisan vendor:publish --provider="AlertNotification\AlertNotificationServiceProvider" --tag="config"
```

## Step 4: Publish Assets (Optional)

```bash
php artisan vendor:publish --provider="AlertNotification\AlertNotificationServiceProvider" --tag="assets"
```

## Step 5: Update Your Master Layout

Add these directives to your master layout file:

```blade
<!DOCTYPE html>
<html>
<head>
    <title>Your App</title>
    @alert::style
</head>
<body>
    <!-- Your content -->
    
    @alert::notification
    @alert::script
</body>
</html>
```

## Step 6: Test in Controller

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        alert_success('Plugin is working!');
        alert_error('This is an error message');
        alert_warning('This is a warning');
        alert_info('This is info message');
        
        return view('your-view');
    }
}
```

## Step 7: Add Routes (for testing)

```php
// routes/web.php
Route::get('/test-alerts', [TestController::class, 'test']);
Route::post('/test-alerts', [TestController::class, 'testAlerts']);
```
