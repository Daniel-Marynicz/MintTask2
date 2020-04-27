<?php

namespace App\Tests\Behat\Context;

use Behat\MinkExtension\Context\RawMinkContext;

class WebContext extends RawMinkContext
{
    /**
     * Checks, that form field with specified id|name|label|value exist
     * Example: Then the "username" field should exist
     * Example: And the "username" field should exist
     *
     * @Then /^the "(?P<field>(?:[^"]|\\")*)" field should exist$/
     */
    public function assertFieldExist($field)
    {
        $field = $this->fixStepArgument($field);
        $this->assertSession()->fieldExists($field);
    }

    /**
     * Returns fixed step argument (with \\" replaced back to ")
     *
     * @param string $argument
     *
     * @return string
     */
    private function fixStepArgument(string $argument): string
    {
        return str_replace('\\"', '"', $argument);
    }
}
