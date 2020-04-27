<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use App\Entity\User;
use Behat\MinkExtension\Context\RawMinkContext;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\UserInterface;
use function serialize;

class AuthContext extends RawMinkContext
{
    private Session $session;

    private string $firewallName;

    private string $firewallContext;

    private TokenStorageInterface $tokenStorage;

    public function __construct(
        Session $session,
        TokenStorageInterface $tokenStorage,
        string $firewallName,
        string $firewallContext
    ) {
        $this->session         = $session;
        $this->tokenStorage    = $tokenStorage;
        $this->firewallName    = $firewallName;
        $this->firewallContext = $firewallContext;
    }

    /**
     * @Given I am logged in as :user
     */
    public function iAmLoggedInAsA(User $user) : void
    {
        $this->bypassAuthentication($user);

        $this->setCookieInClient();
    }

    private function bypassAuthentication(UserInterface $user) : void
    {
        $token = $this->createAuthenticationToken($user);
        $this->storeInSession($token);
        $this->storeInTokenStorage($token);
    }

    private function createAuthenticationToken(UserInterface $user) : TokenInterface
    {
        /**
         * @var string[] $roles
         */
        $roles = $user->getRoles();

        return new UsernamePasswordToken($user, null, $this->firewallName, $roles);
    }

    private function storeInSession(TokenInterface $token) : void
    {
        $this->session->set('_security_' . $this->firewallContext, serialize($token));
        $this->session->save();
    }

    private function storeInTokenStorage(TokenInterface $token) : void
    {
        $this->tokenStorage->setToken($token);
    }

    private function setCookieInClient() : void
    {
        $driver = $this->getSession()->getDriver();
        $driver->setCookie($this->session->getName(), $this->session->getId());
    }
}
