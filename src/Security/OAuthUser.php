<?php

namespace VictorMacko\Security;

use KnpU\OAuth2ClientBundle\Security\User\OAuthUser as BaseOAuthUser;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;

class OAuthUser extends BaseOAuthUser
{
    public function __construct(
        $username,
        array $roles,
        private ResourceOwnerInterface $data,
        private AccessToken $accessToken
    ) {
        parent::__construct($username, $roles);
    }

    public function getAccessToken(): AccessToken
    {
        return $this->accessToken;
    }
}