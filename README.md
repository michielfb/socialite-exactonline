# Exact Online Socialite Provider
This package extends the laravel/socialite package. It allows to create a 'login with Exact Online' feature within minutes.

# Installation
Use the steps below to install the package.

##1. Composer
`composer require michielfb/socialite-exactonline`

##2. Register the service provider

- Remove the default SocialiteServiceProvider from your providers array in `config/app.php`
- Add `SocialiteProviders\Manager\ServiceProvider::class` to your providers array in `config/app.php`

##3. Add an event and listener

Add the listener to the `listen` array in `EventServiceProvider` :

    protected $listen = [
        ...
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            '\Michielfb\SocialiteExactonline\ExactonlineExtendsSocialite@handle',
        ],
        ...
    ];

##4. Register the client_id and client_secret
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
