<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\Entity;

use PHPUnit_Framework_TestCase as TestCase;
use OldTown\Workflow\Spi\Doctrine\Entity\Entry;
use OldTown\Workflow\Spi\Doctrine\Entity\AbstractStep;

/**
 * Class AbstractStepTest
 *
 * @package OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\Entity
 */
class AbstractStepTest extends TestCase
{
    /**
     * @var Entry
     */
    protected $entry;

    /**
     * Проверка установки/получения id
     */
    public function testSetEntry()
    {
        $entry = new Entry();

        /** @var AbstractStep $step */
        $step = $this->getMockForAbstractClass(AbstractStep::class);

        $step->setEntry($entry);
        $step->setEntry($entry);
        $step->setEntry($entry);

        static::assertCount(1, $entry->getCurrentSteps());
        static::assertEquals($step, $entry->getCurrentSteps()->current());

    }

}
