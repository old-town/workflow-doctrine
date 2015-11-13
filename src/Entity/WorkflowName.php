<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity;

use OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class WorkflowName
 *
 * @ORM\Entity()
 * @ORM\Table(name="workflow_name")
 *
 * @package OldTown\Workflow\Spi\Doctrine
 */
class WorkflowName
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="workflow_name", type="string")
     * @ORM\GeneratedValue(strategy="NONE")
     *
     * @var string
     */
    protected $workflowName;

    /**
     * @ORM\ManyToOne(targetEntity="OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow",  cascade={"persist"})
     * @ORM\JoinColumn(name="workflow_descriptor_id", referencedColumnName="entity_id")
     *
     *
     * @var Workflow
     */
    protected $workflowDescriptor;

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
     * @return Workflow
     */
    public function getWorkflowDescriptor()
    {
        return $this->workflowDescriptor;
    }

    /**
     * @param Workflow $workflowDescriptor
     *
     * @return $this
     */
    public function setWorkflowDescriptor(Workflow $workflowDescriptor)
    {
        $this->workflowDescriptor = $workflowDescriptor;

        return $this;
    }


}
