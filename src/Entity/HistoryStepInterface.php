<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity;

/**
 * Interface HistoryStepInterface
 *
 * @package OldTown\Workflow\Spi\Doctrine\Entity
 */
interface HistoryStepInterface extends StepInterface
{
    /**
     * @param CurrentStepInterface $step
     *
     * @throws Exception\InvalidArgumentException
     */
    public function __construct(CurrentStepInterface $step);
}
