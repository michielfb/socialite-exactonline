# Exact Online Socialite Provider

In app/services.php add:

    'exactonline' => [
        'client_id' => env('EXACTONLINE_CLIENT_ID'),
        'client_secret' => env('EXACTONLINE_CLIENT_SECRET'),
        'redirect' => env('EXACTONLINE_CALLBACK_URL'),
    ],
    