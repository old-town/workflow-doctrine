<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\GlobalAction\UnconditionalResult;

use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\FunctionDescriptor;
use OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\GlobalAction\UnconditionalResult;

/**
 * Class PreFunction
 *
 * @package OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\GlobalAction\UnconditionalResult
 */
class PreFunction extends FunctionDescriptor
{
    /**
     * @var UnconditionalResult
     */
    protected $unconditionalResult;
}
