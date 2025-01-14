<?php
use Illuminate\Filesystem\Filesystem;



return [
    /*
    |--------------------------------------------------------------------------
    | Midtrans Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration is used to set the credentials for Midtrans API.
    | Make sure to set the keys and environment properly in your .env file.
    |
    */
  
    'server_key' => env('SB-Mid-server-u5pja2z7GZrnhdhUxaBPd4lJ', ''), // Add your Midtrans Server Key
    'client_key' => env('SB-Mid-client-9XmwY5c_p8hgVn3C', ''), // Add your Midtrans Client Key
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false), // Use false for sandbox mode
    'is_sanitized' => true, // Enable request payload sanitization
    'is_secure' => true,
    // 'is_3ds' => true, // Enable 3DSecure
    // 'enabled' => true,
];
