<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class WorkflowName
 *
 * @ORM\Entity()
 * @ORM\Table(name="wf_entry")
 * @ORM\InheritanceType(value="SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 *
 * @package OldTown\Workflow\Spi\Doctrine
 */
abstract class AbstractEntry implements EntryInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var string
     */
    protected $id;

    /**
     * @ORM\Column(name="workflow_name", type="string", length=60)
     *
     *
     * @var string
     */
    protected $workflowName;

    /**
     * @ORM\Column(name="state", type="integer")
     *
     *
     * @var integer
     */
    protected $state;

    /**
     * Шаги привязанные к процессу wf
     *
     * @ORM\OneToMany(targetEntity="Step", mappedBy="entry")
     *
     * @var StepInterface
     */
    protected $steps;

    /**
     * AbstractEntry constructor.
     */
    public function __construct()
    {
        $this->steps = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = (integer)$id;

        return $this;
    }

    /**
     * @return string
     */
    public function getWorkflowName()
    {
        return $this->workflowName;
    }

    /**
     * @param string $workflowName
     *
     * @return $this
     */
    public function setWorkflowName($workflowName)
    {
        $this->workflowName = (string)$workflowName;

        return $this;
    }

    /**
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param integer $state
     *
     * @return $this
     */
    public function setState($state)
    {
        $this->state = (integer)$state;

        return $this;
    }

    /**
     * Определяет иницилазирован ли процесс workflow
     *
     * @return bool
     */
    public function isInitialized()
    {
        return $this->state > 0;
    }


    /**
     * @return ArrayCollection|StepInterface[]
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * @param StepInterface $step
     *
     * @return $this
     */
    public function addCurrentStep(StepInterface $step)
    {
        $step->setEntry($this);
        if (!$this->getSteps()->contains($step)) {
            $this->getSteps()->add($step);
        }

        return $this;
    }
}
