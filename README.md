# Laravel Alert Notification Plugin

A comprehensive Laravel plugin for displaying beautiful, configurable alert notifications with support for multiple positions, colors, and animations.

## Features

- **Configurable Positions**: Top, bottom, center with custom offsets
- **Multiple Color Themes**: Success, error, warning, info, dark, light
- **Laravel Integration**: Blade directives, facades, helper functions
- **Auto-dismiss**: Configurable timeout with hover pause
- **Responsive Design**: Mobile-friendly notifications
- **Session Integration**: Automatic display of Laravel session messages
- **Validation Errors**: Built-in support for Laravel validation errors

## Installation

1. **Install via Composer**:

```bash
composer require sentix/alert
```

2. **Install NPM Dependencies**:

```bash
npm install
```

3. **Publish Configuration**:

```bash
php artisan vendor:publish --provider="Alert\AlertNotificationServiceProvider" --tag="config"
```

3. **Publish Configuration**:

```bash
php artisan vendor:publish --provider="Alert\AlertNotificationServiceProvider" --tag="config"
```

4. **Publish Assets**:

```bash
php artisan vendor:publish --provider="Alert\AlertNotificationServiceProvider" --tag="assets"
```

## Usage

### Blade Directives

Add these directives to your master layout file:

```blade
<!DOCTYPE html>
<html>
<head>
    <title>Your App</title>
    @alertStyles
</head>
<body>
    <!-- Your content -->

    @alertNotifications
    @alertScripts
</body>
</html>
```

### Helper Functions

```php
// In your controllers
session()->flash('success','Welcome to sentixtech.com');
session()->flash('error','Welcome to sentixtech.com');
session()->flash('info','Welcome to sentixtech.com');
session()->flash('warning','Welcome to sentixtech.com');
```

### JavaScript Usage

```javascript
// Show alerts programmatically
notify("success", "Dynamic success message");
notify("error", "Dynamic error message", "Custom Title");

// Legacy support
notify(false, "Success message"); // false = success
notify(true, "Error message"); // true = error
```

## Configuration

Edit `config/alert-notification.php` to customize:

### Position Settings

```php
'position' => [
    'vertical' => 'bottom',   // top, bottom, center
    'horizontal' => 'right',  // left, right, center
    'offset' => [
        'top' => '20px',
        'bottom' => '20px',
        'left' => '20px',
        'right' => '20px',
    ]
],
```

### Color Customization

```php
'colors' => [
    'success' => [
        'background' => '#28a745',
        'text' => '#ffffff',
        'border' => '#1e7e34'
    ],
    // ... other colors
],
```

### Animation Settings

```php
'animation' => [
    'duration' => '0.35s',
    'easing' => 'cubic-bezier(0.21, 1.02, 0.73, 1)',
    'auto_dismiss' => true,
    'dismiss_timeout' => 5000, // milliseconds
],
```

## Available Alert Types

- `success` - Green success messages
- `error` - Red error messages
- `warning` - Yellow warning messages
- `info` - Blue informational messages
- `dark` - Dark themed messages
- `light` - Light themed messages

## Laravel Session Integration

The plugin automatically displays Laravel session messages:

```php
// In your controller
return redirect()->back()->with('success', 'Data saved successfully!');
return redirect()->back()->with('error', 'Validation failed!');
return redirect()->back()->with('warning', 'Please review your input!');
return redirect()->back()->with('info', 'Additional information...');
```

## Validation Errors

Validation errors are automatically displayed:

```php
// In your controller
$request->validate([
    'email' => 'required|email',
    'name' => 'required|min:3'
]);
// Validation errors will automatically show as notifications
```

## Advanced Configuration

### Custom Icons

You can customize icons in the configuration file by modifying the `icons` array.

### Progress Bar

Enable progress bar for auto-dismiss:

```php
'enable_progress_bar' => true,
'progress_bar_height' => '4px',
```

### Sound Notifications

```php
'Coming Soon!!'
```

## Browser Support

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+

## License

MIT License
