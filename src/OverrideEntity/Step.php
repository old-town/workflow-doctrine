<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\OverrideEntity;


use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\StepDescriptor;
use OldTown\Workflow\Loader\WorkflowDescriptor;

/**
 * Class Step
 *
 * @package OldTown\Workflow\Spi\Doctrine\OverrideEntity
 */
class Step extends StepDescriptor
{
    /**
     * Связь с дескриптором WorkflowDescriptor
     *
     * @var WorkflowDescriptor
     */
    protected $workflowDescriptor;

}
