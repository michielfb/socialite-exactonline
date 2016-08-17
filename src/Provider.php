<?php
namespace Michielfb\SocialiteExactonline;

use Laravel\Socialite\Two\ProviderInterface;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class Provider extends AbstractProvider implements ProviderInterface
{
    const IDENTIFIER = 'exactonline';

    protected $baseUrl = 'https://start.exactonline.nl';

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase($this->baseUrl . '/api/oauth2/auth', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return $this->baseUrl . '/api/oauth2/token';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get($this->baseUrl . '/api/v1/current/Me', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'content-type'  => 'application/json',
                'accept'        => 'application/json',
            ],
        ]);

        $user = json_decode($response->getBody()->getContents(), true);

        return $user['d']['results'][0];
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id'        => $user['UserID'],
            'name'      => $user['FullName'],
            'email'     => $user['Email'],
            'avatar'    => $user['PictureUrl'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }
}
