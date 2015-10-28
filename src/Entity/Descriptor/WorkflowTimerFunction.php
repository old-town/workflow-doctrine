<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity\Descriptor;


use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\FunctionDescriptor;
use OldTown\Workflow\Loader\WorkflowDescriptor;

/**
 * Class WorkflowName
 *
 * @ORM\Entity()
 *
 * @package OldTown\Workflow\Spi\Doctrine\Entity\Descriptor
 */
class WorkflowTimerFunction extends FunctionDescriptor
{

    /**
     * @ORM\ManyToOne(targetEntity="OldTown\Workflow\Loader\WorkflowDescriptor",  inversedBy="timerFunctions")
     * @ORM\JoinColumn(name="workflow_descriptor_id", referencedColumnName="entity_id")
     *
     *
     * @var WorkflowDescriptor
     */
    protected $workflowDescriptor;
}
