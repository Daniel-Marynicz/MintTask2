<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;
use Behatch\Asserter;
use Behatch\Html;
use function array_values;
use function count;
use function implode;
use function sprintf;

class TableContext extends RawMinkContext
{
    use Html;
    use Asserter;

    /**
     * Checks that the data matches the given schema
     *
     * @param TableNode<string[]> $tableNode
     *
     * @Then the data of the :table table should match:
     */
    public function theDataOfTheTableShouldMatch(string $table, TableNode $tableNode) : void
    {
        $rowsSelector      = sprintf('%s tbody tr', $table);
        $htmlRows          = $this->getSession()->getPage()->findAll('css', $rowsSelector);
        $actualCountRows   = count($htmlRows);
        $expectedCountRows = count($tableNode->getRows()) - 1;
        $this->assertEquals($expectedCountRows, $actualCountRows);

        foreach ($tableNode as $index => $row) {
            $expectedText = implode(' ', array_values($row));
            $this->assertArrayHasKey($index, $htmlRows);
            $htmlRow    = $htmlRows[$index];
            $actualText = $htmlRow->getText();
            $this->assertEquals($expectedText, $actualText);
        }
    }
}
