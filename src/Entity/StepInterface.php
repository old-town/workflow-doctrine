<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use DateTime;
use OldTown\Workflow\Spi\StepInterface as BaseStepInterface;


/**
 * Interface StepInterface
 *
 * @package OldTown\Workflow\Spi\Doctrine\Entity
 */
interface StepInterface extends BaseStepInterface
{
    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id);

    /**
     * @param DateTime $startDate
     *
     * @return $this
     */
    public function setStartDate(DateTime $startDate);

    /**
     * @param DateTime $dueDate
     *
     * @return $this
     */
    public function setDueDate(DateTime $dueDate = null);

    /**
     * @param string $owner
     *
     * @return $this
     */
    public function setOwner($owner);

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setStatus($status);

    /**
     * @param string $stepId
     *
     * @return $this
     */
    public function setStepId($stepId);

    /**
     * @return EntryInterface
     */
    public function getEntry();

    /**
     * @param EntryInterface $entry
     *
     * @return $this
     */
    public function setEntry(EntryInterface $entry);

    /**
     * Возвращает id предыдущхи шагов
     *
     */
    public function getPreviousStepIds();

    /**
     * @return ArrayCollection|AbstractStep[]
     */
    public function getPreviousSteps();

    /**
     * @param ArrayCollection|AbstractStep[] $previousSteps
     *
     * @return $this
     *
     * @throws Exception\InvalidArgumentException
     */
    public function setPreviousSteps($previousSteps);
}
