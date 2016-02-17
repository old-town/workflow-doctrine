<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class CurrentStep
 *
 * @package OldTown\Workflow\Spi\Doctrine\Entity
 *
 * @ORM\Entity(repositoryClass="\OldTown\Workflow\Spi\Doctrine\EntityRepository\StepRepository")
 */
class CurrentStep extends AbstractStep implements CurrentStepInterface
{
    /**
     * @ORM\ManyToOne(targetEntity="AbstractEntry", inversedBy="currentSteps")
     * @ORM\JoinColumn(name="entry_id", referencedColumnName="id")
     *
     * @var EntryInterface
     */
    protected $entry;

    /**
     * @return EntryInterface
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * @param EntryInterface $entry
     *
     * @return $this
     */
    public function setEntry(EntryInterface $entry)
    {
        $this->entry = $entry;

        if (!$entry->getCurrentSteps()->contains($this)) {
            $entry->getCurrentSteps()->add($this);
        }

        return $this;
    }
}
