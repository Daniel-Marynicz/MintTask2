<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Tests\Behat\Services\StringManipulator;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use InvalidArgumentException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserContext implements Context
{
    private StringManipulator $stringManipulator;
    private UserPasswordEncoderInterface $passwordEncoder;
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository,
        UserPasswordEncoderInterface $passwordEncoder,
        StringManipulator $stringManipulator
    ) {
        $this->userRepository    = $userRepository;
        $this->passwordEncoder   = $passwordEncoder;
        $this->stringManipulator = $stringManipulator;
    }

    /**
     * @param TableNode<string[]> $table
     *
     * @throws ORMException
     * @throws OptimisticLockException
     *
     * @Given there are following users:
     */
    public function thereAreFollowingUsers(TableNode $table) : void
    {
        foreach ($table as $row) {
            $user = new User();
            $user->setUsername($row['username']);
            $enabled = $row['enabled'] ?? true;
            $user->setEnabled((bool) $enabled);
            $roles = $row['roles'] ?? '[]';
            $roles = $this->stringManipulator->castStringToArray($roles) ?? [];
            $user->setRoles($roles);
            $password = $row['password'] ?? 'some-password';
            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,
                    $password
                )
            );
            $this->userRepository->getEntityManager()->persist($user);
        }

        $this->userRepository->getEntityManager()->flush();
    }

    /**
     * @Transform :user
     */
    public function castUsernameToUser(string $user) : User
    {
        $userObject = $this->userRepository->findOneByUsername($user);
        if (! $userObject instanceof User) {
            throw new InvalidArgumentException('There is no user with username ' . $user);
        }

        return $userObject;
    }
}
