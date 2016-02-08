<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\Entity;

use PHPUnit_Framework_TestCase as TestCase;
use OldTown\Workflow\Spi\Doctrine\Entity\Entry;
use OldTown\Workflow\Spi\Doctrine\Entity\CurrentStep;

/**
 * Class CurrentStepTest
 *
 * @package OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\Entity
 */
class CurrentStepTest extends TestCase
{
    /**
     * Проверка установки/получения id
     */
    public function testSetEntry()
    {
        $entry = new Entry();

        $step = new CurrentStep();

        $step->setEntry($entry);
        $step->setEntry($entry);
        $step->setEntry($entry);

        static::assertCount(1, $entry->getCurrentSteps());
        static::assertEquals($step, $entry->getCurrentSteps()->current());
    }
}
