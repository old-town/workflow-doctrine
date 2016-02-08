<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\Entity;

use OldTown\Workflow\Spi\Doctrine\Entity\CurrentStep;
use PHPUnit_Framework_TestCase as TestCase;
use OldTown\Workflow\Spi\Doctrine\Entity\Entry;
use OldTown\Workflow\Spi\Doctrine\Entity\HistoryStep;

/**
 * Class HistoryStepTest
 *
 * @package OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\Entity
 */
class HistoryStepTest extends TestCase
{
    /**
     * Проверка установки/получения id
     */
    public function testSetEntry()
    {
        $entry = new Entry();

        $step = new CurrentStep();
        $step->setStartDate(new \DateTime());

        $step->setEntry($entry);
        $step->setEntry($entry);
        $step->setEntry($entry);

        $historyStep = new HistoryStep($step);


        static::assertCount(1, $entry->getHistorySteps());
        static::assertEquals($historyStep, $entry->getHistorySteps()->current());
    }
}
