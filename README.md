# Exact Online Socialite Provider

Add a section to the array `app/services.php`. The `base_url` is optional. By default it will use the url for The Netherlands.

    return [
        ...
        'exactonline' => [
            'client_id' => env('EXACTONLINE_CLIENT_ID'),
            'client_secret' => env('EXACTONLINE_CLIENT_SECRET'),
            'redirect' => env('EXACTONLINE_CALLBACK_URL'),
            'base_url' => env('EXACTONLINE_BASE_URL'),
        ],
        ....
    ];

Add the listener to the `listen` array in `EventServiceProvider` :

    protected $listen = [
        ...
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            '\Michielfb\SocialiteExactonline\ExactonlineExtendsSocialite@handle',
        ],
        ...
    ];
