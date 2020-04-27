<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Nelmio\Alice\Loader\NativeLoader;
use Nelmio\Alice\ObjectSet;

class FakeUserFixtures extends UserFixtures implements FixtureGroupInterface
{
    protected function getObjectSet() : ObjectSet
    {
        return (new NativeLoader())->loadFile(__DIR__ . '/FakeUserFixtures.yaml');
    }

    /**
     * {@inheritDoc}
     */
    public static function getGroups() : array
    {
        return ['fake'];
    }
}
