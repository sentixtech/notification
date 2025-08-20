<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Alert Notification Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration options for the Alert Notification
    | plugin. You can customize positions, colors, and other settings here.
    |
    */

    'position' => [
        'vertical' => 'top', // top, bottom, center
        'horizontal' => 'right', // left, right, center
        'offset' => [
            'top' => '20px',
            'bottom' => '20px',
            'left' => '20px',
            'right' => '20px',
        ]
    ],

    'colors' => [
        'success' => [
            'background' => '#28a745',
            'text' => '#ffffff',
            'border' => '#1e7e34'
        ],
        'error' => [
            'background' => '#dc3545',
            'text' => '#ffffff',
            'border' => '#bd2130'
        ],
        'warning' => [
            'background' => '#ffc107',
            'text' => '#212529',
            'border' => '#e0a800'
        ],
        'info' => [
            'background' => '#17a2b8',
            'text' => '#ffffff',
            'border' => '#138496'
        ],
        'dark' => [
            'background' => '#343a40',
            'text' => '#ffffff',
            'border' => '#23272b'
        ],
        'light' => [
            'background' => '#f8f9fa',
            'text' => '#212529',
            'border' => '#dee2e6'
        ]
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
        'margin_bottom' => '8px'
    ],

    'icons' => [
        'success' => '<svg class="toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>',
        'error' => '<svg class="toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>',
        'warning' => '<svg class="toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>',
        'info' => '<svg class="toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>',
        'dark' => '<svg class="toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>',
        'light' => '<svg class="toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>'
    ],

    'enable_progress_bar' => true,
    'progress_bar_height' => '4px',
];
