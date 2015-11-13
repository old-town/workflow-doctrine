<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\GlobalAction\Result;

use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\FunctionDescriptor;
use OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\GlobalAction\Result;

/**
 * Class PostFunction
 *
 * @package OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\GlobalAction\Result
 */
class PostFunction extends FunctionDescriptor
{
    /**
     * @var Result
     */
    protected $result;
}
