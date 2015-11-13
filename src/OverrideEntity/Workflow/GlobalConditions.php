<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow;


use OldTown\Workflow\Loader\ConditionsDescriptor;
use OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow;

/**
 * Class GlobalConditions
 *
 * @package OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow
 */
class GlobalConditions extends ConditionsDescriptor
{
    protected $parentCondition;
}
