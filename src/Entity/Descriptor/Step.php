<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity;


use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\StepDescriptor;
use OldTown\Workflow\Loader\WorkflowDescriptor;

/**
 * Class WorkflowName
 *
 * @ORM\Entity()
 *
 * @package OldTown\Workflow\Spi\Doctrine
 */
class Step extends StepDescriptor
{
    /**
     *
     *
     * @var WorkflowDescriptor
     */
    protected $workflowDescriptor;

}
