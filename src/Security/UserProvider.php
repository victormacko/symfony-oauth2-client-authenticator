<?php

namespace VictorMacko\Security;

use Exception;
use KnpU\OAuth2ClientBundle\Security\User\OAuthUserProvider;
use Symfony\Component\Security\Core\Exception\CredentialsExpiredException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;

class UserProvider extends OAuthUserProvider
{
    public function __construct()
    {
        parent::__construct([]);
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        throw new Exception('Cannot load by identifier');
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof OAuthUser) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        if ($user->getAccessToken()->getExpires() < time()) {
            throw new CredentialsExpiredException();
        }

        return $user;
    }

    public function supportsClass($class): bool
    {
        return OAuthUser::class === $class;
    }
}