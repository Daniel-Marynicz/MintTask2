<?php

namespace App\Tests\Behat\Context;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Tests\Behat\Services\StringManipulator;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use InvalidArgumentException;

class UserContext implements Context
{
    private StringManipulator $stringManipulator;
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository, StringManipulator $stringManipulator)
    {
        $this->userRepository = $userRepository;
        $this->stringManipulator = $stringManipulator;
    }

    /**
     * @Given there are following users:
     */
    public function thereAreFollowingUsers(TableNode $table) : void
    {
        foreach ($table as $row) {
            $user = new User();
            $user->setUsername($row['username']);
            $user->setEnabled($row['enabled'] ?? true);
            $roles = $this->stringManipulator->castStringToArray($row['roles']) ?? [];
            $user->setRoles($roles);
        }
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

