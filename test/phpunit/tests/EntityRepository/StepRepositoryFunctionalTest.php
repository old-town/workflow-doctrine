<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\EntityRepository;

use OldTown\Workflow\Spi\Doctrine\Entity\CurrentStep;
use OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils\EntityManagerAwareTrait;
use PHPUnit_Framework_TestCase as TestCase;
use OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils\DirUtilTrait;
use OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils\EntityManagerAwareInterface;
use OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils\DbTrait;
use OldTown\Workflow\Spi\Doctrine\EntityRepository\StepRepository;

/**
 * Class StepRepositoryFunctionalTest
 *
 * @package OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\EntityRepository
 */
class StepRepositoryFunctionalTest extends TestCase implements EntityManagerAwareInterface
{
    use DirUtilTrait, DbTrait, EntityManagerAwareTrait;

    /**
     * Подготавливаем базу
     *
     */
    protected function setUp()
    {
        $this->dropSchema();
        $this->createSchema();

        parent::setUp();
    }

    /**
     * Поиск сущностей по списку id. Проверка когда передали пустые значения
     *
     */
    public function testFindByIdsEmptyInputData()
    {
        /** @var StepRepository $repo */
        $repo = $this->getEntityManager()->getRepository(CurrentStep::class);
        static::assertEmpty($repo->findByIds([]));
    }

    /**
     * Поиск сущностей по списку id. Проверка когда есть не найденные значения
     *
     * @expectedException \OldTown\Workflow\Spi\Doctrine\EntityRepository\Exception\RuntimeException
     * @expectedExceptionMessage error search step
     */
    public function testFindByIdsInvalidResult()
    {
        /** @var StepRepository $repo */
        $repo = $this->getEntityManager()->getRepository(CurrentStep::class);
        $repo->findByIds([-8]);
    }


    /**
     * Поиск сущностей по списку id.
     *
     */
    public function testFindByIds()
    {
        $step = new CurrentStep();
        $step->setStartDate(new \DateTime());
        $step->setStepId(-7);
        $this->getEntityManager()->persist($step);
        $this->getEntityManager()->flush();

        /** @var StepRepository $repo */
        $repo = $this->getEntityManager()->getRepository(CurrentStep::class);
        $actualStep = $repo->findByIds([$step->getId()]);

        static::assertEquals($step, current($actualStep));
    }
}
