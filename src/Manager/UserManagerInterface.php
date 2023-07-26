<?php

declare(strict_types=1);

namespace League\Bundle\OAuth2ServerBundle\Manager;

use Symfony\Component\Security\Core\User\UserInterface;

interface UserManagerInterface
{
    public function findOneByIdentifier(string $identifier): ?UserInterface;
}
