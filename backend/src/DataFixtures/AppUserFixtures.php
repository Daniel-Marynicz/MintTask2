<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Nelmio\Alice\Loader\NativeLoader;
use Nelmio\Alice\ObjectSet;

class AppUserFixtures extends UserFixtures implements FixtureGroupInterface
{
    protected function getObjectSet() : ObjectSet
    {
        return (new NativeLoader())->loadFile(__DIR__ . '/AppUserFixtures.yaml');
    }

    /**
     * {@inheritDoc}
     */
    public static function getGroups() : array
    {
        return [
            'user',
            'app',
        ];
    }
}
