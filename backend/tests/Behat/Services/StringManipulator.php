<?php

namespace App\Tests\Behat\Services;

class StringManipulator
{
    /**
     * @return string[]
     */
    public function castStringToArray(string $string) : array
    {
        $string = ltrim($string, '[');
        $string = rtrim($string, ']');

        $array = preg_replace('/\s/', '', explode(',', $string));
        if ($array === null) {
            throw new \InvalidArgumentException('Couldn\'t convert string to array');
        }

        return empty($string) ? [] : $array;
    }
}