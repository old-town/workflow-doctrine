<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\GlobalAction;

use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\FunctionDescriptor;
use OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\GlobalAction;

/**
 * Class PreFunction
 *
 * @package OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\GlobalAction
 */
class PreFunction extends FunctionDescriptor
{

    /**
     * @var GlobalAction
     */
    protected $globalAction;
}
