<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\Entity;

use PHPUnit_Framework_TestCase as TestCase;
use OldTown\Workflow\Spi\Doctrine\Entity\Step;
use OldTown\Workflow\Spi\Doctrine\Entity\DefaultEntry;

/**
 * Class StepTest
 *
 * @package OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\Entity
 */
class StepTest extends TestCase
{
    /**
     * Проверка установки/получения id
     */
    public function testSetterGetterId()
    {
        $step = new Step();
        $expectedId = -7;
        static::assertEquals($step, $step->setId($expectedId));
        static::assertEquals($expectedId, $step->getId());
    }

    /**
     * Проверка установки/получения actionId
     */
    public function testSetterGetterActionId()
    {
        $step = new Step();
        $expectedActionId = -7;
        static::assertEquals($step, $step->setActionId($expectedActionId));
        static::assertEquals($expectedActionId, $step->getActionId());
    }

    /**
     * Проверка установки/получения caller
     */
    public function testSetterGetterCaller()
    {
        $step = new Step();
        $expected = 'test_caller';
        static::assertEquals($step, $step->setCaller($expected));
        static::assertEquals($expected, $step->getCaller());
    }

    /**
     * Проверка установки/получения finishDate
     */
    public function testSetterGetterFinishDate()
    {
        $step = new Step();
        $expected = new \DateTime();
        static::assertEquals($step, $step->setFinishDate($expected));
        static::assertEquals($expected, $step->getFinishDate());
    }


    /**
     * Проверка установки/получения startDate
     */
    public function testSetterGetterStartDate()
    {
        $step = new Step();
        $expected = new \DateTime();
        static::assertEquals($step, $step->setStartDate($expected));
        static::assertEquals($expected, $step->getStartDate());
    }


    /**
     * Проверка установки/получения dueDate
     */
    public function testSetterGetterDueDate()
    {
        $step = new Step();
        $expected = new \DateTime();
        static::assertEquals($step, $step->setDueDate($expected));
        static::assertEquals($expected, $step->getDueDate());
    }


    /**
     * Проверка установки/получения owner
     */
    public function testSetterGetterOwner()
    {
        $step = new Step();
        $expected = 'test_owner';
        static::assertEquals($step, $step->setOwner($expected));
        static::assertEquals($expected, $step->getOwner());
    }

    /**
     * Проверка установки/получения owner
     */
    public function testSetterGetterStatus()
    {
        $step = new Step();
        $expected = 'test_status';
        static::assertEquals($step, $step->setStatus($expected));
        static::assertEquals($expected, $step->getStatus());
    }


    /**
     * Проверка установки/получения stepId
     */
    public function testSetterGetterStepId()
    {
        $step = new Step();
        $expected = '-7';
        static::assertEquals($step, $step->setStepId($expected));
        static::assertEquals($expected, $step->getStepId());
    }


    /**
     * Проверка получения entryId
     */
    public function testGetEntryId()
    {
        /** @var Step|\PHPUnit_Framework_MockObject_MockObject $step */
        $step = $this->getMock(Step::class, ['getEntry']);

        $expected = -7;

        $entry = new DefaultEntry();
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
        $step = new Step();


        /** @noinspection PhpParamsInspection */
        $step->setPreviousSteps(-7);
    }


    /**
     * Попытка установить предыдущие шаги. Массив содержит, данные не являющиеся шагом
     *
     * @expectedException \OldTown\Workflow\Spi\Doctrine\Entity\Exception\InvalidArgumentException
     * @expectedExceptionMessage step not implement OldTown\Workflow\Spi\Doctrine\Entity\StepInterface
     */
    public function testSetPreviousStepsInvalidStep()
    {
        $step = new Step();

        $step->setPreviousSteps([7]);
    }


    /**
     * Попытка установить предыдущие шаги. Массив содержит, данные не являющиеся шагом
     *
     */
    public function testSetPreviousSteps()
    {
        $pStep1 = new Step();

        $step = new Step();
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
        $pStep1 =new Step();
        $pStep1->setId(-7);

        $pStep2 = new Step();
        $pStep2->setId(-8);

        $pStep3 = new Step();
        $pStep3->setId(-9);

        $step = new Step();
        $step->setPreviousSteps([$pStep1, $pStep2, $pStep3]);

        static::assertEmpty(array_diff([-7, -8, -9], $step->getPreviousStepIds()));
    }
}
