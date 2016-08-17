# Exact Online Socialite Provider

Add a section to the array `app/services.php`:

    return [
        ...
        'exactonline' => [
            'client_id' => env('EXACTONLINE_CLIENT_ID'),
            'client_secret' => env('EXACTONLINE_CLIENT_SECRET'),
            'redirect' => env('EXACTONLINE_CALLBACK_URL'),
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
