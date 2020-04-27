<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Nelmio\Alice\ObjectSet;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use function assert;
use function is_string;

abstract class UserFixtures extends Fixture
{
    private UserRepository $userRepository;
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserRepository $userRepository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository  = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    abstract protected function getObjectSet() : ObjectSet;

    public function load(ObjectManager $manager) : void
    {
        $users = $this->getObjectSet()->getObjects();

        foreach ($users as $user) {
            assert($user instanceof User && $user instanceof UserInterface);
            assert(is_string($user->getUsername()));
            assert(is_string($user->getPlainPassword()));

            if ($this->userRepository->findOneByUsername($user->getUsername())) {
                continue;
            }

            $user->setPassword(
                $this->passwordEncoder->encodePassword($user, $user->getPlainPassword())
            );
            $manager->persist($user);
        }

        $manager->flush();
    }
}
