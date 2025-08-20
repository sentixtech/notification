<?php

namespace Alert;
use Illuminate\Support\Facades\File; 

class AlertNotificationManager
{
    protected $config;

    public function __construct($config = [])
    {
        $this->config = is_array($config) ? $config : [];
        
        // Set default config if empty
        if (empty($this->config)) {
            $this->config = [
                'position' => [
                    'vertical' => 'bottom',
                    'horizontal' => 'right',
                    'offset' => [
                        'top' => '20px',
                        'bottom' => '20px',
                        'left' => '20px',
                        'right' => '20px',
                    ]
                ],
                'colors' => [
                    'success' => ['background' => '#28a745', 'text' => '#ffffff', 'border' => '#1e7e34'],
                    'error' => ['background' => '#dc3545', 'text' => '#ffffff', 'border' => '#bd2130'],
                    'warning' => ['background' => '#ffc107', 'text' => '#212529', 'border' => '#e0a800'],
                    'info' => ['background' => '#17a2b8', 'text' => '#ffffff', 'border' => '#138496'],
                ],
                'animation' => [
                    'duration' => '0.35s',
                    'easing' => 'cubic-bezier(0.21, 1.02, 0.73, 1)',
                    'auto_dismiss' => true,
                    'dismiss_timeout' => 5000,
                ],
                'styling' => [
                    'border_radius' => '6px',
                    'box_shadow' => '0 4px 12px rgba(0, 0, 0, 0.15)',
                    'width' => '350px',
                    'max_width' => '100%',
                    'z_index' => 9999,
                    'font_size' => '14px',
                    'margin_bottom' => '15px'
                ],
                'icons' => [
                    'success' => '<svg class="toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>',
                    'error' => '<svg class="toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>',
                    'warning' => '<svg class="toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>',
                    'info' => '<svg class="toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>',
                ],
                'enable_progress_bar' => false,
                'progress_bar_height' => '4px',
            ];
        }
    }

    /**
     * Render CSS styles based on configuration
     */
    public function renderStyles(): string
{
    $position   = $this->config['position'];
    $colors     = $this->config['colors'];
    $styling    = $this->config['styling'];
    $animation  = $this->config['animation'];
    $progress   = $this->config['enable_progress_bar'] ? $this->config['progress_bar_height'] : '0px';
    $src        = asset('notification/notification.css');
    $cssVars = "
    <style>
        :root {
            /* 🔹 Position */
            --toast-top: " . ($position['vertical'] === 'top' ? $position['offset']['top'] : 'auto') . ";
            --toast-bottom: " . ($position['vertical'] === 'bottom' ? $position['offset']['bottom'] : 'auto') . ";
            --toast-left: " . ($position['horizontal'] === 'left' ? $position['offset']['left'] : 'auto') . ";
            --toast-right: " . ($position['horizontal'] === 'right' ? $position['offset']['right'] : 'auto') . ";

            /* 🔹 Animation */
            --toast-duration: {$animation['duration']};
            --toast-easing: {$animation['easing']};

            /* 🔹 Styling */
            --toast-border-radius: {$styling['border_radius']};
            --toast-box-shadow: {$styling['box_shadow']};
            --toast-width: {$styling['width']};
            --toast-max-width: {$styling['max_width']};
            --toast-z-index: {$styling['z_index']};
            --toast-font-size: {$styling['font_size']};
            --toast-margin-bottom: {$styling['margin_bottom']};

            /* 🔹 Colors */
            --toast-success-bg: {$colors['success']['background']};
            --toast-success-color: {$colors['success']['text']};
            --toast-success-border: {$colors['success']['border']};

            --toast-error-bg: {$colors['error']['background']};
            --toast-error-color: {$colors['error']['text']};
            --toast-error-border: {$colors['error']['border']};

            --toast-warning-bg: {$colors['warning']['background']};
            --toast-warning-color: {$colors['warning']['text']};
            --toast-warning-border: {$colors['warning']['border']};

            --toast-info-bg: {$colors['info']['background']};
            --toast-info-color: {$colors['info']['text']};
            --toast-info-border: {$colors['info']['border']};

            --toast-dark-bg: {$colors['dark']['background']};
            --toast-dark-color: {$colors['dark']['text']};
            --toast-dark-border: {$colors['dark']['border']};

            --toast-light-bg: {$colors['light']['background']};
            --toast-light-color: {$colors['light']['text']};
            --toast-light-border: {$colors['light']['border']};
            /* 🔹 Progress bar */
            --toast-progress-height: {$progress};
        }
    </style>
    ";

    $css = "<link href=\"{$src}\" rel='stylesheet' type='text/css'/>\n" . $cssVars;

    return $css;
}


    /**
     * Render JavaScript functionality
     */
  

    public function renderScripts(): string
    {
        $config = json_encode($this->config);
    
        $src = asset('notification/notification.js');
        $js  = "<script>window.AlertNotificationConfig = {$config};</script>\n";
        if ($src) {
            $js .= "<script src=\"{$src}\"></script>";
        }
    
        return $js;
    }
    
    

    /**
     * Render notification HTML
     */
    public function renderNotifications(): string
    {
        $notifications = [];
    
        foreach (['success', 'error', 'warning', 'info'] as $type) {
            if (session()->has($type)) {
                $notifications[] = [
                    'type' => $type,
                    'message' => session()->get($type),
                    'title' => ucfirst($type),
                ];
            }
        }
    
        // Validation errors
        if (isset($GLOBALS['errors']) && $GLOBALS['errors']->any()) {
            $notifications[] = [
                'type' => 'error',
                'message' => '<ul><li>' . implode('</li><li>', $GLOBALS['errors']->all()) . '</li></ul>',
                'title' => 'Validation Errors',
            ];
        }
    
        // Pass notifications as JSON for JS
        $json = json_encode($notifications);
    
        return <<<HTML
            <div class="toast-container" aria-live="polite" aria-atomic="true"></div>
            <script>
                window.ServerNotifications = $json;
            </script>
        HTML;
    }
     
}
