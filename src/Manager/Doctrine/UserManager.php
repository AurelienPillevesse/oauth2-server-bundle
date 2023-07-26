<?php

declare(strict_types=1);

namespace League\Bundle\OAuth2ServerBundle\Manager\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use League\Bundle\OAuth2ServerBundle\Event\PreSaveClientEvent;
use League\Bundle\OAuth2ServerBundle\Manager\ClientFilter;
use League\Bundle\OAuth2ServerBundle\Manager\ClientManagerInterface;
use League\Bundle\OAuth2ServerBundle\Manager\UserManagerInterface;
use League\Bundle\OAuth2ServerBundle\Model\AbstractClient;
use League\Bundle\OAuth2ServerBundle\Model\ClientInterface;
use League\Bundle\OAuth2ServerBundle\OAuth2Events;
use League\Bundle\OAuth2ServerBundle\ValueObject\Grant;
use League\Bundle\OAuth2ServerBundle\ValueObject\RedirectUri;
use League\Bundle\OAuth2ServerBundle\ValueObject\Scope;
use League\OAuth2\Server\Entities\UserEntityInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class UserManager implements UserManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var class-string<UserEntityInterface>
     */
    private $userFqcn;

    /**
     * @param class-string<UserEntityInterface> $userFqcn
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        string $userFqcn
    ) {
        $this->entityManager = $entityManager;
        $this->userFqcn = $userFqcn;
    }

    public function findOneByIdentifier(string $identifier): ?UserInterface
    {
        $repository = $this->entityManager->getRepository($this->userFqcn);

        return $repository->findOneBy(['identifier' => $identifier]);
    }
}
