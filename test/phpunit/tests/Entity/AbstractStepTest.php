<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\Entity;

use PHPUnit_Framework_TestCase as TestCase;
use OldTown\Workflow\Spi\Doctrine\Entity\AbstractStep;
use OldTown\Workflow\Spi\Doctrine\Entity\Entry;

/**
 * Class AbstractStepTest
 *
 * @package OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\Entity
 */
class AbstractStepTest extends TestCase
{
    /**
     * Проверка установки/получения id
     */
    public function testSetterGetterId()
    {
        /** @var AbstractStep $step */
        $step = $this->getMockForAbstractClass(AbstractStep::class);
        $expectedId = -7;
        static::assertEquals($step, $step->setId($expectedId));
        static::assertEquals($expectedId, $step->getId());
    }

    /**
     * Проверка установки/получения actionId
     */
    public function testSetterGetterActionId()
    {
        /** @var AbstractStep $step */
        $step = $this->getMockForAbstractClass(AbstractStep::class);
        $expectedActionId = -7;
        static::assertEquals($step, $step->setActionId($expectedActionId));
        static::assertEquals($expectedActionId, $step->getActionId());
    }

    /**
     * Проверка установки/получения caller
     */
    public function testSetterGetterCaller()
    {
        /** @var AbstractStep $step */
        $step = $this->getMockForAbstractClass(AbstractStep::class);
        $expected = 'test_caller';
        static::assertEquals($step, $step->setCaller($expected));
        static::assertEquals($expected, $step->getCaller());
    }

    /**
     * Проверка установки/получения finishDate
     */
    public function testSetterGetterFinishDate()
    {
        /** @var AbstractStep $step */
        $step = $this->getMockForAbstractClass(AbstractStep::class);
        $expected = new \DateTime();
        static::assertEquals($step, $step->setFinishDate($expected));
        static::assertEquals($expected, $step->getFinishDate());
    }


    /**
     * Проверка установки/получения startDate
     */
    public function testSetterGetterStartDate()
    {
        /** @var AbstractStep $step */
        $step = $this->getMockForAbstractClass(AbstractStep::class);
        $expected = new \DateTime();
        static::assertEquals($step, $step->setStartDate($expected));
        static::assertEquals($expected, $step->getStartDate());
    }


    /**
     * Проверка установки/получения dueDate
     */
    public function testSetterGetterDueDate()
    {
        /** @var AbstractStep $step */
        $step = $this->getMockForAbstractClass(AbstractStep::class);
        $expected = new \DateTime();
        static::assertEquals($step, $step->setDueDate($expected));
        static::assertEquals($expected, $step->getDueDate());
    }


    /**
     * Проверка установки/получения owner
     */
    public function testSetterGetterOwner()
    {
        /** @var AbstractStep $step */
        $step = $this->getMockForAbstractClass(AbstractStep::class);
        $expected = 'test_owner';
        static::assertEquals($step, $step->setOwner($expected));
        static::assertEquals($expected, $step->getOwner());
    }

    /**
     * Проверка установки/получения owner
     */
    public function testSetterGetterStatus()
    {
        /** @var AbstractStep $step */
        $step = $this->getMockForAbstractClass(AbstractStep::class);
        $expected = 'test_status';
        static::assertEquals($step, $step->setStatus($expected));
        static::assertEquals($expected, $step->getStatus());
    }


    /**
     * Проверка установки/получения stepId
     */
    public function testSetterGetterStepId()
    {
        /** @var AbstractStep $step */
        $step = $this->getMockForAbstractClass(AbstractStep::class);
        $expected = '-7';
        static::assertEquals($step, $step->setStepId($expected));
        static::assertEquals($expected, $step->getStepId());
    }


    /**
     * Проверка получения entryId
     */
    public function testGetEntryId()
    {
        /** @var AbstractStep|\PHPUnit_Framework_MockObject_MockObject $step */
        $step = $this->getMockForAbstractClass(AbstractStep::class, ['getEntry']);

        $expected = -7;

        $entry = new Entry();
        $entry->setId($expected);

        $step->expects(static::once())->method('getEntry')->will(static::returnValue($entry));

        static::assertEquals($expected, $step->getEntryId());
    }

    /**
     * Попытка установить предыдущие шаги. Переданные данные не являющиеся массивом
     *
     * @expectedException \OldTown\Workflow\Spi\Doctrine\Entity\Exception\InvalidArgumentException
     * @expectedExceptionMessage previousSteps is not array
     */
    public function testSetPreviousStepsInvalidCollections()
    {
        /** @var AbstractStep|\PHPUnit_Framework_MockObject_MockObject $step */
        $step = $this->getMockForAbstractClass(AbstractStep::class);


        /** @noinspection PhpParamsInspection */
        $step->setPreviousSteps(-7);
    }


    /**
     * Попытка установить предыдущие шаги. Массив содержит, данные не являющиеся шагом
     *
     * @expectedException \OldTown\Workflow\Spi\Doctrine\Entity\Exception\InvalidArgumentException
     * @expectedExceptionMessage step not implement OldTown\Workflow\Spi\Doctrine\Entity\AbstractStep
     */
    public function testSetPreviousStepsInvalidStep()
    {
        /** @var AbstractStep|\PHPUnit_Framework_MockObject_MockObject $step */
        $step = $this->getMockForAbstractClass(AbstractStep::class);

        $step->setPreviousSteps([7]);
    }


    /**
     * Попытка установить предыдущие шаги. Массив содержит, данные не являющиеся шагом
     *
     */
    public function testSetPreviousSteps()
    {

        /** @var AbstractStep|\PHPUnit_Framework_MockObject_MockObject $pStep1 */
        $pStep1 = $this->getMockForAbstractClass(AbstractStep::class);


        /** @var AbstractStep|\PHPUnit_Framework_MockObject_MockObject $step */
        $step = $this->getMockForAbstractClass(AbstractStep::class);
        $step->setPreviousSteps([$pStep1, $pStep1, $pStep1, $pStep1]);

        static::assertCount(1, $step->getPreviousSteps());
        static::assertEquals($pStep1, $step->getPreviousSteps()->current());
    }


    /**
     * Получение набора индификаторов предыдущих шагов
     *
     */
    public function testGetPreviousStepIds()
    {

        /** @var AbstractStep|\PHPUnit_Framework_MockObject_MockObject $pStep1 */
        $pStep1 = $this->getMockForAbstractClass(AbstractStep::class);
        $pStep1->setId(-7);

        /** @var AbstractStep|\PHPUnit_Framework_MockObject_MockObject $pStep2 */
        $pStep2 = $this->getMockForAbstractClass(AbstractStep::class);
        $pStep2->setId(-8);

        /** @var AbstractStep|\PHPUnit_Framework_MockObject_MockObject $pStep3 */
        $pStep3 = $this->getMockForAbstractClass(AbstractStep::class);
        $pStep3->setId(-9);

        /** @var AbstractStep|\PHPUnit_Framework_MockObject_MockObject $step */
        $step = $this->getMockForAbstractClass(AbstractStep::class);
        $step->setPreviousSteps([$pStep1, $pStep2, $pStep3]);

        static::assertEmpty(array_diff([-7, -8, -9], $step->getPreviousStepIds()));
    }
}
