<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class LoginAttemptService
{
    private const MAX_ATTEMPTS = 3;
    private const BLOCK_TIME = 900; // 15 minutes en secondes

    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    public function checkAttempts(string $username): void
    {
        $session = $this->requestStack->getSession();
        $attempts = $session->get('login_attempts_' . $username, []);

        // Nettoyer les anciennes tentatives
        $attempts = array_filter($attempts, function($timestamp) {
            return $timestamp > time() - self::BLOCK_TIME;
        });

        if (count($attempts) >= self::MAX_ATTEMPTS) {
            $timeLeft = max(array_values($attempts)) + self::BLOCK_TIME - time();
            throw new CustomUserMessageAuthenticationException(
                sprintf('Trop de tentatives de connexion. Réessayez dans %d minutes.', ceil($timeLeft / 60))
            );
        }

        // Ajouter la nouvelle tentative
        $attempts[] = time();
        $session->set('login_attempts_' . $username, $attempts);
    }

    public function clearAttempts(string $username): void
    {
        $this->requestStack->getSession()->remove('login_attempts_' . $username);
    }
}
